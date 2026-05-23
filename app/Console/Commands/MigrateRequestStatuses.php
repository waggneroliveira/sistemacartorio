<?php

namespace App\Console\Commands;

use App\Models\RegistryServiceRequest;
use App\Models\RequestStatus;
use Illuminate\Console\Command;

class MigrateRequestStatuses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:request-statuses';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate old status values to new RequestStatus relationship';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Iniciando migração de status das solicitações...');

        $mapping = [
            'pending' => 'pending',
            'in_progress' => 'in_progress',
            'awaiting_documents' => 'awaiting_documents',
            'documents_approved' => 'documents_approved',
            'completed' => 'completed',
            'rejected' => 'rejected',
        ];

        $updated = 0;

        foreach ($mapping as $oldStatus => $newStatus) {
            $requestStatus = RequestStatus::where('name', $newStatus)->first();

            if (!$requestStatus) {
                $this->warn("Status '$newStatus' não encontrado na tabela request_statuses");
                continue;
            }

            $count = RegistryServiceRequest::where('status', $oldStatus)
                ->where('request_status_id', null)
                ->update([
                    'request_status_id' => $requestStatus->id,
                ]);

            if ($count > 0) {
                $this->info("✓ Atualizado $count solicitação(ões) com status '$oldStatus'");
                $updated += $count;
            }
        }

        $this->info("✓ Migração concluída! Total de $updated solicitações atualizadas.");
    }
}
