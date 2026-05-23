# 🔄 Fluxo de Funcionalidades - Sistema de Solicitações

## Diagrama de Fluxo Completo

```
┌─────────────────────────────────────────────────────────────────────────┐
│                     SOLICITAÇÃO DE SERVIÇO CRIADA                       │
│                      Status: PENDENTE (Padrão)                          │
│                  Protocolo: CRT-26-05-00001 (Gerado)                    │
└──────────────────────────┬──────────────────────────────────────────────┘
                          │
                          ▼
┌─────────────────────────────────────────────────────────────────────────┐
│                   ADMIN ACESSA PAINEL                                    │
│            /painel/solicitacoes-de-servicos/{id}                        │
│                                                                          │
│   ├─ Ver dados do cliente (nome, email, telefone)                       │
│   ├─ Ver serviço solicitado                                             │
│   ├─ Ver campos dinâmicos preenchidos                                   │
│   ├─ Ver documentos enviados                                            │
│   └─ Ver histórico completo de alterações                              │
└──────────────────────────┬──────────────────────────────────────────────┘
                          │
                ┌─────────┴─────────┐
                │                   │
                ▼                   ▼
        ┌──────────────┐    ┌─────────────────┐
        │   ANALISAR   │    │  ATRIBUIR A     │
        │  SOLICITAÇÃO │    │   RESPONSÁVEL   │
        └──────┬───────┘    └────────┬────────┘
               │                     │
               ▼                     ▼
        ┌──────────────────────────────────┐
        │  Status: EM PROGRESSO            │
        │  Atribuído a: João Silva         │
        │  [Auditoria] João alterou status │
        └──────┬───────────────────────────┘
               │
        ┌──────┴────────────────────────────┐
        │                                   │
        ▼                                   ▼
┌─────────────────────────┐    ┌────────────────────────┐
│  DOCUMENTOS SUFICIENTES? │    │  PRECISA DE DOCUMENTOS?│
└────────┬────────────────┘    └──────┬─────────────────┘
         │                            │
         NO                           YES
         │                            │
         ▼                            ▼
    ┌───────────────────────────────────────────────────┐
    │ Clique: "SOLICITAR DOCUMENTOS"                    │
    │ ├─ Selecione documentos necessários               │
    │ ├─ Adicione mensagem para o cliente               │
    │ └─ Envie solicitação                              │
    └───────────┬───────────────────────────────────────┘
                │
                ▼
    ┌───────────────────────────────────────────────────┐
    │  Status: AGUARDANDO DOCUMENTOS                     │
    │  [Email enviado ao cliente com lista de docs]     │
    │  [Auditoria] Admin solicitou documentos            │
    └───────────┬───────────────────────────────────────┘
                │
                ▼
    ┌───────────────────────────────────────────────────┐
    │  CLIENTE ENVIA DOCUMENTOS                          │
    │  [Documentos são salvos em uploaded_files]        │
    └───────────┬───────────────────────────────────────┘
                │
                ▼
    ┌───────────────────────────────────────────────────┐
    │  Clique: "APROVAR DOCUMENTOS"                      │
    │  ├─ Adicione notas de aprovação (opcional)        │
    │  └─ Salve aprovação                               │
    └───────────┬───────────────────────────────────────┘
                │
                ▼
    ┌───────────────────────────────────────────────────┐
    │  Status: DOCUMENTOS APROVADOS                      │
    │  [Auditoria] Admin aprovou documentos              │
    └───────────┬───────────────────────────────────────┘
                │
    ┌───────────┴────────────────────────┐
    │                                    │
    ▼                                    ▼
┌──────────────────┐      ┌──────────────────────────┐
│ ADICIONAR        │      │ ADICIONAR OBSERVAÇÕES    │
│ OBSERVAÇÕES      │      │ INTERNAS                 │
│ INTERNAS         │      │                          │
└────────┬─────────┘      │ [Notas privadas para     │
         │                │  equipe apenas]          │
         │                │                          │
         │                │ Texto: "Aguardando       │
         │                │ resposta da prefeitura"  │
         │                │                          │
         │                │ [Auditoria] Registrada   │
         │                └──────────┬───────────────┘
         │                           │
         └───────────────┬───────────┘
                         │
                         ▼
    ┌────────────────────────────────────┐
    │ PROCESSAR SOLICITAÇÃO               │
    │ (Análise finalizada)                │
    │                                    │
    │ Clique: "ENCERRAR SOLICITAÇÃO"     │
    └───────────┬──────────────────────┘
                │
    ┌───────────┴──────────┐
    │                      │
    ▼                      ▼
┌──────────────────┐ ┌──────────────────┐
│ RESULTADO:       │ │ RESULTADO:       │
│ APROVADO         │ │ REJEITADO        │
│                  │ │                  │
│ Status:          │ │ Status:          │
│ CONCLUÍDO        │ │ REJEITADO        │
│ (Final)          │ │ (Final)          │
└────────┬─────────┘ └────────┬─────────┘
         │                    │
         ▼                    ▼
    ┌────────────────────────────────────┐
    │ [Email enviado ao cliente]          │
    │ [Auditoria] Solicitação finalizada  │
    │ [Relatório gerado]                  │
    └────────────────────────────────────┘
         │
         │ Se precisar ajustes
         │
         ▼
    ┌────────────────────────────────────┐
    │ Clique: "REABRIR SOLICITAÇÃO"       │
    │ Status volta para: EM PROGRESSO     │
    │ [Auditoria] Solicitação reabierta   │
    └────────────────────────────────────┘
```

---

## Estados Possíveis e Transições

```
                    ┌──────────────┐
                    │   PENDENTE   │ ◄─── Status Padrão
                    │  (Inicial)   │
                    └──────┬───────┘
                           │
                           ▼
                    ┌──────────────┐
                    │  EM PROGRESSO│
                    │              │
                    └──────┬───────┘
                           │
           ┌───────────────┼───────────────┐
           ▼               ▼               ▼
    ┌──────────────┐ ┌────────────────────────┐
    │ CONCLUÍDO    │ │ AGUARDANDO DOCUMENTOS  │
    │   (Final)    │ │     (Intermediário)    │
    └──────────────┘ └──────────┬─────────────┘
           ▲                     │
           │                     ▼
           │          ┌──────────────────────┐
           │          │ DOCUMENTOS APROVADOS │
           │          │   (Intermediário)    │
           │          └──────────┬───────────┘
           │                     │
           └─────────────────────┘

    ┌──────────────┐
    │  REJEITADO   │ ◄─── Status Final
    │   (Final)    │
    └──────────────┘

    Observação: Estados finais (CONCLUÍDO, REJEITADO) podem
                retornar para EM PROGRESSO via "Reabrir"
```

---

## Registros de Auditoria Criados Automaticamente

```
Cada alteração cria um registro em request_audit_trails com:

┌─────────────────────────────────────────┐
│ action: "status_changed"                │
│ user_id: 1                              │
│ user_name: "João Silva"                 │
│ old_data: {status_id: 1, status: "pending"} │
│ new_data: {status_id: 2, status: "in_progress"} │
│ changes: {old_status: "Pendente", new_status: "Em Progresso"} │
│ ip_address: "192.168.1.100"             │
│ user_agent: "Mozilla/5.0..."            │
│ created_at: "2026-05-23 15:30:00"       │
└─────────────────────────────────────────┘

Tipos de Actions Registrados:
- status_changed
- internal_note_added
- assigned_to_user
- documents_requested
- documents_approved
- request_closed
- request_reopened
```

---

## Estrutura de Dados Armazenada

### 1. internal_notes (JSON Array)
```json
[
  {
    "timestamp": "2026-05-23T15:30:00Z",
    "user_id": 1,
    "user_name": "Admin User",
    "text": "Cliente necessita documentação adicional"
  },
  {
    "timestamp": "2026-05-23T16:45:00Z",
    "user_id": 2,
    "user_name": "Maria Silva",
    "text": "Documentos recebidos. Aguardando análise jurídica"
  }
]
```

### 2. document_requests (JSON Object)
```json
{
  "timestamp": "2026-05-23T15:30:00Z",
  "requested_by_id": 1,
  "requested_by": "Admin User",
  "documents": ["RG", "CPF", "Comprovante de Residência"],
  "message": "Por favor, envie os documentos solicitados para completar a análise"
}
```

### 3. document_approval (JSON Object)
```json
{
  "timestamp": "2026-05-23T17:00:00Z",
  "approved_by_id": 1,
  "approved_by": "Admin User",
  "notes": "Documentos em ordem. Prosseguindo com a análise"
}
```

### 4. closing_data (JSON Object)
```json
{
  "timestamp": "2026-05-23T18:00:00Z",
  "closed_by_id": 1,
  "closed_by": "Admin User",
  "result": "completed",
  "notes": "Solicitação completada com sucesso. Documentos encaminhados ao cliente"
}
```

---

## Ações Disponíveis por Status

```
PENDENTE
├─ Alterar para: EM PROGRESSO, AGUARDANDO DOCUMENTOS
├─ Ações: Solicitar Documentos, Adicionar Obs., Atribuir
└─ Permitido: Deletar

EM PROGRESSO
├─ Alterar para: AGUARDANDO DOCUMENTOS, CONCLUÍDO, REJEITADO
├─ Ações: Solicitar Documentos, Adicionar Obs., Atribuir
└─ Permitido: Nenhum

AGUARDANDO DOCUMENTOS
├─ Alterar para: DOCUMENTOS APROVADOS
├─ Ações: Aprovar Documentos, Adicionar Obs.
└─ Permitido: Solicitar novos documentos

DOCUMENTOS APROVADOS
├─ Alterar para: EM PROGRESSO, CONCLUÍDO, REJEITADO
├─ Ações: Adicionar Obs., Atribuir
└─ Permitido: Encerrar

CONCLUÍDO (Final)
├─ Ações: Reabrir, Ver histórico
└─ Permitido: Nenhum outro

REJEITADO (Final)
├─ Ações: Reabrir, Ver histórico
└─ Permitido: Nenhum outro
```

---

## Endpoints AJAX para Integração

```javascript
// Atualizar Status
PATCH /painel/solicitacoes-de-servicos/{id}/status
Body: { request_status_id: 2 }

// Adicionar Observação Interna
POST /painel/solicitacoes-de-servicos/{id}/internal-note
Body: { note: "Texto da observação" }

// Atribuir a Usuário
POST /painel/solicitacoes-de-servicos/{id}/assign-user
Body: { assigned_to: 2 }

// Solicitar Documentos
POST /painel/solicitacoes-de-servicos/{id}/request-documents
Body: { 
  required_documents: ["RG", "CPF"],
  message: "Mensagem para cliente"
}

// Aprovar Documentos
POST /painel/solicitacoes-de-servicos/{id}/approve-documents
Body: { approval_notes: "Notas opcionais" }

// Encerrar Solicitação
POST /painel/solicitacoes-de-servicos/{id}/close
Body: {
  closing_notes: "Notas de encerramento",
  result: "completed" // ou "rejected"
}

// Reabrir Solicitação
POST /painel/solicitacoes-de-servicos/{id}/reopen
Body: {}
```

---

## Performance e Índices

```sql
-- request_audit_trails
CREATE INDEX idx_registry_service_request_id ON request_audit_trails(registry_service_request_id);
CREATE INDEX idx_action ON request_audit_trails(action);
CREATE INDEX idx_created_at ON request_audit_trails(created_at);

-- registry_service_requests
CREATE UNIQUE INDEX idx_protocol_number ON registry_service_requests(protocol_number);
CREATE INDEX idx_request_status_id ON registry_service_requests(request_status_id);
CREATE INDEX idx_assigned_to ON registry_service_requests(assigned_to);
```

---

## Testes Recomendados

```
1. [ ] Criar um novo status personalizado
2. [ ] Alterar o status de uma solicitação
3. [ ] Adicionar observação interna
4. [ ] Atribuir solicitação a um responsável
5. [ ] Solicitar documentos
6. [ ] Aprovar documentos
7. [ ] Encerrar solicitação
8. [ ] Reabrir solicitação encerrada
9. [ ] Verificar histórico completo
10. [ ] Exportar lista de solicitações
11. [ ] Testar filtros avançados
12. [ ] Verificar protocolo gerado
```

---

**Implementação Concluída com Sucesso! 🎉**
