<?php
declare(strict_types=1);

namespace App\Controller\Api\Sample;

use App\Controller\AppController;
use Cake\Core\Configure;
use Sample\Common\Infrastructure\Cakephp\Transaction;
use Sample\Task\Application\SampleDeleteApplicationService;
use Sample\Task\Application\SampleDeleteCommand;
use Sample\Task\Infrastructure\Cakephp\SampleRepository;

class SampleDeleteController extends AppController
{
    /**
     * @param string $sampleId sampleId
     * @return void
     */
    public function handle(string $sampleId): void
    {
        $transaction = new Transaction();
        $sampleRepository = new SampleRepository();
        $applicationService = new SampleDeleteApplicationService(
            $transaction,
            $sampleRepository
        );

        $applicationService = Configure::read('Mock.SampleDeleteApplicationService', $applicationService);

        $command = new SampleDeleteCommand(
            $sampleId
        );

        $result = $applicationService->handle($command);

        $this->set('data', []);
        $this->viewBuilder()->setOption('serialize', ['data']);
    }
}
