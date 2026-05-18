<?php

namespace Database\Seeders;

use App\Models\RegistryService;
use Illuminate\Database\Seeder;

class RegistryServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'Certidão de Nascimento',
                'icon' => 'bi-baby',
                'required_documents' => [
                    "RG do requerente (original digitalizado)",
                    "CPF (frente e verso ou imagem do documento)",
                    "Comprovante de endereço recente",
                    "Dados dos pais (nomes completos)"
                ],
                'instructions' => "A certidão pode ser solicitada para 1ª ou 2ª via. É necessário apresentar documento oficial com foto.",
                'dynamic_fields' => [
                    ['type' => 'select', 'name' => 'tipoCertidao', 'label' => 'Tipo de certidão', 'obrigatorio' => true, 'opcoes' => ["1ª Via", "2ª Via"]],
                    ['type' => 'text', 'name' => 'nomeMae', 'label' => 'Nome completo da mãe', 'obrigatorio' => true, 'placeholder' => "Digite o nome da mãe"],
                    ['type' => 'text', 'name' => 'nomePai', 'label' => 'Nome completo do pai', 'obrigatorio' => false, 'placeholder' => "Digite o nome do pai (opcional)"],
                    ['type' => 'date', 'name' => 'dataNascimento', 'label' => 'Data de nascimento', 'obrigatorio' => true, 'placeholder' => ""]
                ],
                'display_order' => 1,
            ],
            [
                'name' => 'Certidão de Casamento',
                'icon' => 'bi-hearts',
                'required_documents' => [
                    "RG e CPF de ambos os cônjuges",
                    "Certidão de nascimento atualizada (se for 1ª via)",
                    "Comprovante de residência",
                    "Documento de identificação de 2 testemunhas"
                ],
                'instructions' => "Para certidão de casamento, informar data e local do casamento. Caso seja averbação, especificar.",
                'dynamic_fields' => [
                    ['type' => 'text', 'name' => 'nomeConjuge1', 'label' => 'Nome do primeiro cônjuge', 'obrigatorio' => true, 'placeholder' => "Nome completo"],
                    ['type' => 'text', 'name' => 'nomeConjuge2', 'label' => 'Nome do segundo cônjuge', 'obrigatorio' => true, 'placeholder' => "Nome completo"],
                    ['type' => 'date', 'name' => 'dataCasamento', 'label' => 'Data do casamento', 'obrigatorio' => true, 'placeholder' => ""],
                    ['type' => 'text', 'name' => 'localCasamento', 'label' => 'Local do casamento (cidade/estado)', 'obrigatorio' => true, 'placeholder' => "Ex: São Paulo - SP"],
                    ['type' => 'select', 'name' => 'tipoAverbacao', 'label' => 'Tipo de solicitação', 'obrigatorio' => true, 'opcoes' => ["1ª Via", "2ª Via", "Averbação"]]
                ],
                'display_order' => 2,
            ],
            [
                'name' => 'Escritura de Compra e Venda',
                'icon' => 'bi-house-door',
                'required_documents' => [
                    "RG e CPF de comprador e vendedor",
                    "Matrícula atualizada do imóvel (certidão) - até 30 dias",
                    "Comprovante de quitação de IPTU/ITR",
                    "Certidão de casamento ou declaração de união estável"
                ],
                'instructions' => "Documentos devem estar com assinatura digitalizada. Solicitamos também certidão negativa de débitos.",
                'dynamic_fields' => [
                    ['type' => 'text', 'name' => 'nomeComprador', 'label' => 'Nome completo do comprador', 'obrigatorio' => true, 'placeholder' => "Nome completo"],
                    ['type' => 'text', 'name' => 'cpfComprador', 'label' => 'CPF do comprador', 'obrigatorio' => true, 'placeholder' => "000.000.000-00"],
                    ['type' => 'text', 'name' => 'nomeVendedor', 'label' => 'Nome completo do vendedor', 'obrigatorio' => true, 'placeholder' => "Nome completo"],
                    ['type' => 'text', 'name' => 'cpfVendedor', 'label' => 'CPF do vendedor', 'obrigatorio' => true, 'placeholder' => "000.000.000-00"],
                    ['type' => 'text', 'name' => 'enderecoImovel', 'label' => 'Endereço completo do imóvel', 'obrigatorio' => true, 'placeholder' => "Rua, número, bairro, cidade"],
                    ['type' => 'text', 'name' => 'matriculaImovel', 'label' => 'Número da matrícula do imóvel', 'obrigatorio' => true, 'placeholder' => "Nº da matrícula no cartório"],
                    ['type' => 'number', 'name' => 'valorVenda', 'label' => 'Valor da venda (R$)', 'obrigatorio' => true, 'placeholder' => "Ex: 250000"]
                ],
                'display_order' => 3,
            ],
            [
                'name' => 'Reconhecimento de Firma',
                'icon' => 'bi-pen',
                'required_documents' => [
                    "Documento original com foto (RG/CNH)",
                    "CPF",
                    "Documento a ser reconhecido (original)",
                    "Comprovante de endereço"
                ],
                'instructions' => "Envie foto legível do documento a ser reconhecido. O atendente orientará presencial ou por videoconferência.",
                'dynamic_fields' => [
                    ['type' => 'select', 'name' => 'tipoReconhecimento', 'label' => 'Tipo de reconhecimento', 'obrigatorio' => true, 'opcoes' => ["Por semelhança", "Por autenticidade"]],
                    ['type' => 'text', 'name' => 'documentoReconhecer', 'label' => 'Descrição do documento a ser reconhecido', 'obrigatorio' => true, 'placeholder' => "Ex: Contrato de aluguel, procuração, etc."],
                    ['type' => 'select', 'name' => 'formaAtendimento', 'label' => 'Forma de atendimento preferencial', 'obrigatorio' => true, 'opcoes' => ["Presencial", "Videoconferência", "Online com token"]]
                ],
                'display_order' => 4,
            ],
            [
                'name' => 'Abertura de Inventário',
                'icon' => 'bi-folder-symlink',
                'required_documents' => [
                    "Certidão de óbito do falecido",
                    "RG, CPF e certidão de nascimento/casamento dos herdeiros",
                    "Relação de bens e documentos dos imóveis/veículos",
                    "Último comprovante de residência do falecido"
                ],
                'instructions' => "Processo judicial ou extrajudicial. Você receberá orientação personalizada.",
                'dynamic_fields' => [
                    ['type' => 'text', 'name' => 'nomeFalecido', 'label' => 'Nome completo do falecido', 'obrigatorio' => true, 'placeholder' => "Nome completo"],
                    ['type' => 'date', 'name' => 'dataObito', 'label' => 'Data do óbito', 'obrigatorio' => true, 'placeholder' => ""],
                    ['type' => 'text', 'name' => 'cartorioObito', 'label' => 'Cartório onde foi registrado o óbito', 'obrigatorio' => true, 'placeholder' => "Nome do cartório e cidade"],
                    ['type' => 'number', 'name' => 'numeroHerdeiros', 'label' => 'Número de herdeiros', 'obrigatorio' => true, 'placeholder' => "Quantidade de herdeiros"],
                    ['type' => 'select', 'name' => 'tipoInventario', 'label' => 'Tipo de inventário', 'obrigatorio' => true, 'opcoes' => ["Judicial", "Extrajudicial (cartório)"]],
                    ['type' => 'textarea', 'name' => 'relacaoBens', 'label' => 'Relação resumida dos bens', 'obrigatorio' => false, 'placeholder' => "Descreva os principais bens (imóveis, veículos, etc.)"]
                ],
                'display_order' => 5,
            ],
        ];

        foreach ($services as $service) {
            RegistryService::create($service);
        }
    }
}