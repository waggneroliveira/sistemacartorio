{{-- resources/views/client/auth/complement_registration.blade.php --}}
@extends('client.core.client')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 bg-[#0a2b1f]">
                <h2 class="text-2xl font-bold text-white">Complementação Cadastral</h2>
                <p class="text-gray-300 text-sm mt-1">Complete seus dados para finalizar o cadastro</p>
            </div>
            {{-- {{ route('complement-registration.store') }} --}}
            <form method="POST" action="" enctype="multipart/form-data" class="p-6">
                @csrf
                
                <!-- Progresso -->
                <div class="mb-8">
                    <div class="flex justify-between mb-2">
                        <span class="text-sm font-medium text-[#0d9488]">Progresso do cadastro</span>
                        <span class="text-sm font-medium text-[#0d9488]">40%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-[#0d9488] h-2 rounded-full" style="width: 40%"></div>
                    </div>
                </div>
                
                <!-- Dados Pessoais -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-[#0a2b1f] mb-4 pb-2 border-b-2 border-[#0d9488]">
                        Dados Pessoais
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Nome completo *</label>
                            <input type="text" name="full_name" required value="{{ old('full_name') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#0d9488] focus:ring-[#0d9488]">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700">CPF *</label>
                            <input type="text" name="cpf" id="cpf" required value="{{ old('cpf') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#0d9488] focus:ring-[#0d9488]"
                                   placeholder="000.000.000-00">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700">RG *</label>
                            <input type="text" name="rg" required value="{{ old('rg') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#0d9488] focus:ring-[#0d9488]">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Órgão emissor *</label>
                            <input type="text" name="issuing_body" required value="{{ old('issuing_body') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#0d9488] focus:ring-[#0d9488]">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Data de nascimento *</label>
                            <input type="date" name="birth_date" required value="{{ old('birth_date') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#0d9488] focus:ring-[#0d9488]">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nacionalidade *</label>
                            <select name="nationality" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#0d9488] focus:ring-[#0d9488]">
                                <option value="">Selecione</option>
                                <option value="brasileiro">Brasileiro</option>
                                <option value="naturalizado">Naturalizado</option>
                                <option value="estrangeiro">Estrangeiro</option>
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Estado civil *</label>
                            <select name="marital_status" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#0d9488] focus:ring-[#0d9488]">
                                <option value="">Selecione</option>
                                <option value="solteiro">Solteiro(a)</option>
                                <option value="casado">Casado(a)</option>
                                <option value="divorciado">Divorciado(a)</option>
                                <option value="viuvo">Viúvo(a)</option>
                                <option value="uniao_estavel">União Estável</option>
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nome da mãe *</label>
                            <input type="text" name="mother_name" required value="{{ old('mother_name') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#0d9488] focus:ring-[#0d9488]">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nome do pai</label>
                            <input type="text" name="father_name" value="{{ old('father_name') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#0d9488] focus:ring-[#0d9488]">
                        </div>
                    </div>
                </div>
                
                <!-- Endereço -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-[#0a2b1f] mb-4 pb-2 border-b-2 border-[#0d9488]">
                        Endereço
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">CEP *</label>
                            <input type="text" name="cep" id="cep" required value="{{ old('cep') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#0d9488] focus:ring-[#0d9488]"
                                   placeholder="00000-000">
                        </div>
                        
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Rua *</label>
                            <input type="text" name="street" id="street" required value="{{ old('street') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#0d9488] focus:ring-[#0d9488]">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Número *</label>
                            <input type="text" name="number" required value="{{ old('number') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#0d9488] focus:ring-[#0d9488]">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Complemento</label>
                            <input type="text" name="complement" value="{{ old('complement') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#0d9488] focus:ring-[#0d9488]">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Bairro *</label>
                            <input type="text" name="neighborhood" id="neighborhood" required value="{{ old('neighborhood') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#0d9488] focus:ring-[#0d9488]">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Cidade *</label>
                            <input type="text" name="city" id="city" required value="{{ old('city') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#0d9488] focus:ring-[#0d9488]">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Estado *</label>
                            <select name="state" id="state" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#0d9488] focus:ring-[#0d9488]">
                                <option value="">Selecione</option>
                                <option value="AC">Acre</option>
                                <option value="AL">Alagoas</option>
                                <option value="AP">Amapá</option>
                                <option value="AM">Amazonas</option>
                                <option value="BA">Bahia</option>
                                <option value="CE">Ceará</option>
                                <option value="DF">Distrito Federal</option>
                                <option value="ES">Espírito Santo</option>
                                <option value="GO">Goiás</option>
                                <option value="MA">Maranhão</option>
                                <option value="MT">Mato Grosso</option>
                                <option value="MS">Mato Grosso do Sul</option>
                                <option value="MG">Minas Gerais</option>
                                <option value="PA">Pará</option>
                                <option value="PB">Paraíba</option>
                                <option value="PR">Paraná</option>
                                <option value="PE">Pernambuco</option>
                                <option value="PI">Piauí</option>
                                <option value="RJ">Rio de Janeiro</option>
                                <option value="RN">Rio Grande do Norte</option>
                                <option value="RS">Rio Grande do Sul</option>
                                <option value="RO">Rondônia</option>
                                <option value="RR">Roraima</option>
                                <option value="SC">Santa Catarina</option>
                                <option value="SP">São Paulo</option>
                                <option value="SE">Sergipe</option>
                                <option value="TO">Tocantins</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <!-- Upload de Documentos -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-[#0a2b1f] mb-4 pb-2 border-b-2 border-[#0d9488]">
                        Upload de Documentos
                    </h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">RG *</label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="rg_file" class="relative cursor-pointer bg-white rounded-md font-medium text-[#0d9488] hover:text-[#0a2b1f]">
                                            <span>Upload do RG</span>
                                            <input id="rg_file" name="rg_file" type="file" class="sr-only" accept=".pdf,.jpg,.jpeg,.png">
                                        </label>
                                    </div>
                                    <p class="text-xs text-gray-500">PDF, PNG, JPG até 5MB</p>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700">CPF *</label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="cpf_file" class="relative cursor-pointer bg-white rounded-md font-medium text-[#0d9488] hover:text-[#0a2b1f]">
                                            <span>Upload do CPF</span>
                                            <input id="cpf_file" name="cpf_file" type="file" class="sr-only" accept=".pdf,.jpg,.jpeg,.png">
                                        </label>
                                    </div>
                                    <p class="text-xs text-gray-500">PDF, PNG, JPG até 5MB</p>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Comprovante de residência *</label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="proof_address" class="relative cursor-pointer bg-white rounded-md font-medium text-[#0d9488] hover:text-[#0a2b1f]">
                                            <span>Upload do comprovante</span>
                                            <input id="proof_address" name="proof_address" type="file" class="sr-only" accept=".pdf,.jpg,.jpeg,.png">
                                        </label>
                                    </div>
                                    <p class="text-xs text-gray-500">PDF, PNG, JPG até 5MB</p>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Outros documentos (opcional)</label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="other_documents" class="relative cursor-pointer bg-white rounded-md font-medium text-[#0d9488] hover:text-[#0a2b1f]">
                                            <span>Upload de outros documentos</span>
                                            <input id="other_documents" name="other_documents[]" type="file" multiple class="sr-only" accept=".pdf,.jpg,.jpeg,.png">
                                        </label>
                                    </div>
                                    <p class="text-xs text-gray-500">PDF, PNG, JPG até 5MB (múltiplos arquivos)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Botão de submissão -->
                <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                    <button type="button" onclick="saveProgress()" 
                            class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        Salvar rascunho
                    </button>
                    
                    <button type="submit" 
                            class="px-6 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#0d9488] hover:bg-[#0a2b1f] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0d9488]">
                        Finalizar cadastro
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Máscara para CPF
document.getElementById('cpf').addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, '');
    if (value.length <= 11) {
        value = value.replace(/(\d{3})(\d)/, '$1.$2');
        value = value.replace(/(\d{3})(\d)/, '$1.$2');
        value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
        e.target.value = value;
    }
});

// Busca endereço por CEP
document.getElementById('cep').addEventListener('blur', function() {
    const cep = this.value.replace(/\D/g, '');
    if (cep.length === 8) {
        fetch(`https://viacep.com.br/ws/${cep}/json/`)
            .then(response => response.json())
            .then(data => {
                if (!data.erro) {
                    document.getElementById('street').value = data.logradouro;
                    document.getElementById('neighborhood').value = data.bairro;
                    document.getElementById('city').value = data.localidade;
                    document.getElementById('state').value = data.uf;
                }
            });
    }
});

function saveProgress() {
    // Implementar salvamento parcial do formulário
    alert('Rascunho salvo com sucesso!');
}
</script>
@endsection