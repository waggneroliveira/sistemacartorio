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
                'required_documents' => json_encode([
                    "RG do requerente (original digitalizado)",
                    "CPF (frente e verso ou imagem do documento)",
                    "Comprovante de endereço recente",
                    "Dados dos pais (nomes completos)"
                ]),
                'instructions' => "A certidão pode ser solicitada para 1ª ou 2ª via. É necessário apresentar documento oficial com foto.",
                'dynamic_fields' => json_encode([
                    [
                        'name' => 'tipo_certidao',
                        'label' => 'Tipo de certidão',
                        'type' => 'select',
                        'required' => true,
                        'options' => ["1ª Via", "2ª Via"],
                        'placeholder' => ''
                    ],
                    [
                        'name' => 'nome_mae',
                        'label' => 'Nome completo da mãe',
                        'type' => 'text',
                        'required' => true,
                        'options' => [],
                        'placeholder' => 'Digite o nome completo da mãe'
                    ],
                    [
                        'name' => 'nome_pai',
                        'label' => 'Nome completo do pai',
                        'type' => 'text',
                        'required' => false,
                        'options' => [],
                        'placeholder' => 'Digite o nome completo do pai (opcional)'
                    ],
                    [
                        'name' => 'data_nascimento',
                        'label' => 'Data de nascimento',
                        'type' => 'date',
                        'required' => true,
                        'options' => [],
                        'placeholder' => ''
                    ],
                    [
                        'name' => 'nome_registrado',
                        'label' => 'Nome da pessoa registrada',
                        'type' => 'text',
                        'required' => true,
                        'options' => [],
                        'placeholder' => 'Nome completo como consta no registro'
                    ]
                ]),
                'is_active' => true,
                'display_order' => 1,
            ],
            [
                'name' => 'Certidão de Casamento',
                'icon' => 'bi-hearts',
                'required_documents' => json_encode([
                    "RG e CPF de ambos os cônjuges",
                    "Certidão de nascimento atualizada (se for 1ª via)",
                    "Comprovante de residência",
                    "Documento de identificação de 2 testemunhas"
                ]),
                'instructions' => "Para certidão de casamento, informar data e local do casamento. Caso seja averbação, especificar.",
                'dynamic_fields' => json_encode([
                    [
                        'name' => 'nome_conjuge1',
                        'label' => 'Nome do primeiro cônjuge',
                        'type' => 'text',
                        'required' => true,
                        'options' => [],
                        'placeholder' => 'Nome completo do primeiro cônjuge'
                    ],
                    [
                        'name' => 'nome_conjuge2',
                        'label' => 'Nome do segundo cônjuge',
                        'type' => 'text',
                        'required' => true,
                        'options' => [],
                        'placeholder' => 'Nome completo do segundo cônjuge'
                    ],
                    [
                        'name' => 'data_casamento',
                        'label' => 'Data do casamento',
                        'type' => 'date',
                        'required' => true,
                        'options' => [],
                        'placeholder' => ''
                    ],
                    [
                        'name' => 'local_casamento',
                        'label' => 'Local do casamento',
                        'type' => 'text',
                        'required' => true,
                        'options' => [],
                        'placeholder' => 'Cidade e estado onde ocorreu o casamento'
                    ],
                    [
                        'name' => 'tipo_solicitacao',
                        'label' => 'Tipo de solicitação',
                        'type' => 'select',
                        'required' => true,
                        'options' => ["1ª Via", "2ª Via", "Averbação"],
                        'placeholder' => ''
                    ],
                    [
                        'name' => 'regime_bens',
                        'label' => 'Regime de bens',
                        'type' => 'select',
                        'required' => false,
                        'options' => ["Comunhão Universal", "Comunhão Parcial", "Separação Total", "Participação Final nos Aqüistos"],
                        'placeholder' => ''
                    ]
                ]),
                'is_active' => true,
                'display_order' => 2,
            ],
            [
                'name' => 'Escritura de Compra e Venda',
                'icon' => 'bi-house-door',
                'required_documents' => json_encode([
                    "RG e CPF de comprador e vendedor",
                    "Matrícula atualizada do imóvel (certidão) - até 30 dias",
                    "Comprovante de quitação de IPTU/ITR",
                    "Certidão de casamento ou declaração de união estável"
                ]),
                'instructions' => "Documentos devem estar com assinatura digitalizada. Solicitamos também certidão negativa de débitos.",
                'dynamic_fields' => json_encode([
                    [
                        'name' => 'nome_comprador',
                        'label' => 'Nome completo do comprador',
                        'type' => 'text',
                        'required' => true,
                        'options' => [],
                        'placeholder' => 'Nome completo do comprador'
                    ],
                    [
                        'name' => 'cpf_comprador',
                        'label' => 'CPF do comprador',
                        'type' => 'tel',
                        'required' => true,
                        'options' => [],
                        'placeholder' => '000.000.000-00'
                    ],
                    [
                        'name' => 'nome_vendedor',
                        'label' => 'Nome completo do vendedor',
                        'type' => 'text',
                        'required' => true,
                        'options' => [],
                        'placeholder' => 'Nome completo do vendedor'
                    ],
                    [
                        'name' => 'cpf_vendedor',
                        'label' => 'CPF do vendedor',
                        'type' => 'tel',
                        'required' => true,
                        'options' => [],
                        'placeholder' => '000.000.000-00'
                    ],
                    [
                        'name' => 'endereco_imovel',
                        'label' => 'Endereço completo do imóvel',
                        'type' => 'textarea',
                        'required' => true,
                        'options' => [],
                        'placeholder' => 'Rua, número, bairro, cidade, CEP'
                    ],
                    [
                        'name' => 'matricula_imovel',
                        'label' => 'Número da matrícula do imóvel',
                        'type' => 'text',
                        'required' => true,
                        'options' => [],
                        'placeholder' => 'Nº da matrícula no cartório de registro'
                    ],
                    [
                        'name' => 'cartorio_imovel',
                        'label' => 'Cartório onde o imóvel está registrado',
                        'type' => 'text',
                        'required' => true,
                        'options' => [],
                        'placeholder' => 'Nome do cartório e cidade'
                    ],
                    [
                        'name' => 'valor_venda',
                        'label' => 'Valor da venda',
                        'type' => 'number',
                        'required' => true,
                        'options' => [],
                        'placeholder' => 'Valor em reais (R$)'
                    ],
                    [
                        'name' => 'forma_pagamento',
                        'label' => 'Forma de pagamento',
                        'type' => 'select',
                        'required' => true,
                        'options' => ["À vista", "Financiamento", "Parcelado entre as partes"],
                        'placeholder' => ''
                    ]
                ]),
                'is_active' => true,
                'display_order' => 3,
            ],
            [
                'name' => 'Reconhecimento de Firma',
                'icon' => 'bi-pen',
                'required_documents' => json_encode([
                    "Documento original com foto (RG/CNH)",
                    "CPF",
                    "Documento a ser reconhecido (original)",
                    "Comprovante de endereço"
                ]),
                'instructions' => "Envie foto legível do documento a ser reconhecido. O atendente orientará presencial ou por videoconferência.",
                'dynamic_fields' => json_encode([
                    [
                        'name' => 'tipo_reconhecimento',
                        'label' => 'Tipo de reconhecimento',
                        'type' => 'select',
                        'required' => true,
                        'options' => ["Por semelhança", "Por autenticidade"],
                        'placeholder' => ''
                    ],
                    [
                        'name' => 'documento_reconhecer',
                        'label' => 'Descrição do documento a ser reconhecido',
                        'type' => 'text',
                        'required' => true,
                        'options' => [],
                        'placeholder' => 'Ex: Contrato de aluguel, procuração, declaração, etc.'
                    ],
                    [
                        'name' => 'forma_atendimento',
                        'label' => 'Forma de atendimento preferencial',
                        'type' => 'select',
                        'required' => true,
                        'options' => ["Presencial", "Videoconferência", "Online com token"],
                        'placeholder' => ''
                    ],
                    [
                        'name' => 'quantidade_firmas',
                        'label' => 'Quantidade de firmas a reconhecer',
                        'type' => 'number',
                        'required' => true,
                        'options' => [],
                        'placeholder' => 'Número de assinaturas a serem reconhecidas'
                    ]
                ]),
                'is_active' => true,
                'display_order' => 4,
            ],
            [
                'name' => 'Abertura de Inventário',
                'icon' => 'bi-folder-symlink',
                'required_documents' => json_encode([
                    "Certidão de óbito do falecido",
                    "RG, CPF e certidão de nascimento/casamento dos herdeiros",
                    "Relação de bens e documentos dos imóveis/veículos",
                    "Último comprovante de residência do falecido"
                ]),
                'instructions' => "Processo judicial ou extrajudicial. Você receberá orientação personalizada.",
                'dynamic_fields' => json_encode([
                    [
                        'name' => 'nome_falecido',
                        'label' => 'Nome completo do falecido',
                        'type' => 'text',
                        'required' => true,
                        'options' => [],
                        'placeholder' => 'Nome completo do falecido'
                    ],
                    [
                        'name' => 'cpf_falecido',
                        'label' => 'CPF do falecido',
                        'type' => 'tel',
                        'required' => true,
                        'options' => [],
                        'placeholder' => '000.000.000-00'
                    ],
                    [
                        'name' => 'data_obito',
                        'label' => 'Data do óbito',
                        'type' => 'date',
                        'required' => true,
                        'options' => [],
                        'placeholder' => ''
                    ],
                    [
                        'name' => 'cartorio_obito',
                        'label' => 'Cartório onde foi registrado o óbito',
                        'type' => 'text',
                        'required' => true,
                        'options' => [],
                        'placeholder' => 'Nome do cartório e cidade'
                    ],
                    [
                        'name' => 'numero_herdeiros',
                        'label' => 'Número de herdeiros',
                        'type' => 'number',
                        'required' => true,
                        'options' => [],
                        'placeholder' => 'Quantidade total de herdeiros'
                    ],
                    [
                        'name' => 'tipo_inventario',
                        'label' => 'Tipo de inventário',
                        'type' => 'select',
                        'required' => true,
                        'options' => ["Judicial", "Extrajudicial (cartório)"],
                        'placeholder' => ''
                    ],
                    [
                        'name' => 'relacao_bens',
                        'label' => 'Relação resumida dos bens',
                        'type' => 'textarea',
                        'required' => false,
                        'options' => [],
                        'placeholder' => 'Descreva os principais bens (imóveis, veículos, investimentos, etc.)'
                    ],
                    [
                        'name' => 'testamento',
                        'label' => 'Existe testamento?',
                        'type' => 'select',
                        'required' => true,
                        'options' => ["Não", "Sim, registrado em cartório", "Sim, particular"],
                        'placeholder' => ''
                    ]
                ]),
                'is_active' => true,
                'display_order' => 5,
            ],
            [
                'name' => 'Autenticação de Documentos',
                'icon' => 'bi-shield-check',
                'required_documents' => json_encode([
                    "Documento original a ser autenticado",
                    "Documento oficial com foto do solicitante",
                    "CPF"
                ]),
                'instructions' => "A autenticação pode ser feita online ou presencial. Para online, é necessário token digital.",
                'dynamic_fields' => json_encode([
                    [
                        'name' => 'tipo_documento',
                        'label' => 'Tipo de documento a ser autenticado',
                        'type' => 'select',
                        'required' => true,
                        'options' => ["Cópia de RG", "Cópia de CNH", "Cópia de Certidão", "Cópia de Contrato", "Outros"],
                        'placeholder' => ''
                    ],
                    [
                        'name' => 'descricao_documento',
                        'label' => 'Descrição detalhada do documento',
                        'type' => 'textarea',
                        'required' => true,
                        'options' => [],
                        'placeholder' => 'Descreva o documento que precisa ser autenticado'
                    ],
                    [
                        'name' => 'quantidade_paginas',
                        'label' => 'Quantidade de páginas',
                        'type' => 'number',
                        'required' => true,
                        'options' => [],
                        'placeholder' => 'Número total de páginas'
                    ]
                ]),
                'is_active' => true,
                'display_order' => 6,
            ],
            [
                'name' => 'Registro de Contrato',
                'icon' => 'bi-file-text',
                'required_documents' => json_encode([
                    "Contrato original assinado pelas partes",
                    "Documentos de identificação de todos os signatários",
                    "Comprovante de pagamento de imposto (se aplicável)"
                ]),
                'instructions' => "Contratos de locação, compra e venda, prestação de serviços, entre outros.",
                'dynamic_fields' => json_encode([
                    [
                        'name' => 'tipo_contrato',
                        'label' => 'Tipo de contrato',
                        'type' => 'select',
                        'required' => true,
                        'options' => ["Locação", "Compra e Venda", "Prestação de Serviços", "Sociedade", "Confidencialidade", "Outros"],
                        'placeholder' => ''
                    ],
                    [
                        'name' => 'partes_envolvidas',
                        'label' => 'Partes envolvidas (nomes)',
                        'type' => 'text',
                        'required' => true,
                        'options' => [],
                        'placeholder' => 'Nome das partes que assinam o contrato'
                    ],
                    [
                        'name' => 'data_contrato',
                        'label' => 'Data do contrato',
                        'type' => 'date',
                        'required' => true,
                        'options' => [],
                        'placeholder' => ''
                    ],
                    [
                        'name' => 'valor_contrato',
                        'label' => 'Valor do contrato (se houver)',
                        'type' => 'number',
                        'required' => false,
                        'options' => [],
                        'placeholder' => 'Valor em reais (R$)'
                    ]
                ]),
                'is_active' => true,
                'display_order' => 7,
            ],
        ];

        foreach ($services as $service) {
            RegistryService::create($service);
        }
        
        $this->command->info('Serviços criados com sucesso!');
    }
}