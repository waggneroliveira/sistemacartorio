# Campo de Pagamento nos Registry Services

## 📋 Resumo das Alterações

Implementação de campo de pagamento nos serviços do registro (registry-services) para permitir adicionar o valor do serviço. O campo é opcional (nullable), permitindo serviços gratuitos.

---

## 🔧 Arquivos Modificados

### 1. **Migration** (Nova)
- **Arquivo**: `database/migrations/2026_06_02_add_service_value_to_registry_services_table.php`
- **Alteração**: Criou nova migration para adicionar coluna `service_value` (decimal 10,2) na tabela `registry_services`
- **Tipo de Campo**: decimal(10,2) - nullable, permite valores até 9.999.999,99

### 2. **Model** 
- **Arquivo**: `app/Models/RegistryService.php`
- **Alterações**:
  - Adicionado `'service_value'` no array `$fillable`
  - Adicionado `'service_value' => 'decimal:2'` no array `$casts` para forçar 2 casas decimais

### 3. **Controller - Admin**
- **Arquivo**: `app/Http/Controllers/RegistryServiceController.php`
- **Alterações**:
  - Método `store()`: Adicionada validação `'service_value' => 'nullable|numeric|min:0'`
  - Método `update()`: Adicionada validação `'service_value' => 'nullable|numeric|min:0'`

### 4. **Controller - Client API**
- **Arquivo**: `app/Http/Controllers/Client/RegistryServicePageController.php`
- **Alterações**:
  - Método `getServices()`: Adicionado campo `'valor' => $service->service_value ?? 0` na resposta JSON
  - Método `getServiceById()`: Adicionado campo `'valor' => $service->service_value ?? 0` na resposta JSON

### 5. **View - Form**
- **Arquivo**: `resources/views/admin/blades/registryService/form.blade.php`
- **Alteração**: Adicionado novo campo de entrada:
  ```html
  <div class="mb-3 col-12 col-md-6">
      <label for="service_value" class="form-label">Valor do Serviço (R$)</label>
      <input type="number" name="service_value" class="form-control" id="service_value" 
             step="0.01" min="0" value="{{ old('service_value', $service->service_value ?? '') }}" 
             placeholder="0.00">
      <small class="text-muted">Deixe em branco se o serviço for gratuito</small>
  </div>
  ```

### 6. **View - Index (Tabela)**
- **Arquivo**: `resources/views/admin/blades/registryService/index.blade.php`
- **Alterações**:
  - Adicionada coluna "Valor" no header da tabela
  - Adicionada célula com exibição formatada do valor:
    - Se tem valor: `R$ 45,00` (em badge verde)
    - Se sem valor: `Gratuito` (em badge cinza)

### 7. **Seeder**
- **Arquivo**: `database/seeders/RegistryServiceSeeder.php`
- **Alteração**: Adicionado `service_value` para cada um dos 7 serviços:
  - Certidão de Nascimento: R$ 45,00
  - Certidão de Casamento: R$ 45,00
  - Certidão de Óbito: R$ 45,00
  - Reconhecimento de Firma: R$ 30,00
  - Abertura de Inventário: R$ 150,00
  - Autenticação de Documentos: R$ 40,00
  - Escritura de Compra e Venda: R$ 250,00

---

## ✅ Funcionalidades Implementadas

- ✅ Campo de valor opcional no banco de dados (nullable)
- ✅ Validação no controller (numeric, min:0)
- ✅ Campo de entrada no formulário de criação/edição
- ✅ Exibição formatada na listagem de serviços
- ✅ API retorna o valor do serviço nos endpoints de listar/detalhar
- ✅ Seeder com valores padrão para cada tipo de serviço
- ✅ Migration executada com sucesso

---

## 🚀 Como Usar

### Admin - Criar/Editar Serviço
1. Ir em "Serviços do Cartório"
2. Criar novo serviço ou editar existente
3. Preencher o campo "Valor do Serviço (R$)"
4. Deixar em branco para serviço gratuito

### Frontend - Acessar Valor
Os valores dos serviços estão disponíveis na API em:
- `GET /api/registry-services` - retorna array com campo `valor`
- `GET /api/registry-services/{id}` - retorna o serviço com campo `valor`

---

## 📊 Estrutura do Campo

| Propriedade | Valor |
|---|---|
| Coluna | service_value |
| Tipo | decimal(10,2) |
| Nullable | Sim |
| Default | NULL |
| Validação | numeric, min:0 |

---

## 🔄 Próximos Passos Opcionais

- Adicionar campo de valor nas solicitações (RegistryServiceRequest) para registrar qual era o valor no momento da solicitação
- Integrar com sistema de pagamento
- Adicionar relatório de receita
- Implementar cupom/desconto em alguns serviços
