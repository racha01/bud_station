<?php

namespace App\Domain\Menu\Service;

use App\Domain\Menu\Repository\MenuRepository;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;

/**
 * Service.
 */
final class MenuUpdater
{
    /**
     * @var MenuRepository
     */
    private $repository;

    /**
     * @var MenuValidator
     */
    private $menuValidator;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * The constructor.
     *
     * @param MenuRepository $repository The repository
     * @param MenuValidator $menuValidator The validator
     * @param LoggerFactory $loggerFactory The logger factory
     */
    public function __construct(
        MenuRepository $repository,
        MenuValidator $menuValidator,
        LoggerFactory $loggerFactory
    ) {
        $this->repository = $repository;
        $this->menuValidator = $menuValidator;
        $this->logger = $loggerFactory
            ->addFileHandler('menu_updater.log')
            ->createInstance();
    }

    /**
     * Update menu.
     *
     * @param int $menuId The menu id
     * @param array<mixed> $data The request data
     *
     * @return void
     */
    public function updateMenu(int $menuId, array $data): void
    {
        // Input validation
        $this->menuValidator->validateMenuUpdate($menuId, $data);

        // Map form data to row
        $menuRow = $this->mapToRow($data);

        // Insert menu
        $this->repository->updateMenu($menuId, $menuRow);

        // Logging
        $this->logger->info(sprintf('Menu updated successfully: %s', $menuId));
    }

    public function insertMenu( array $data): int
    {
        // Input validation
        $this->menuValidator->validateMenuInsert($data);

        // Map form data to row
        $Row = $this->mapToRow($data);

        // Insert transferStore
        $id=$this->repository->insertMenu($Row);

        // Logging
        //$this->logger->info(sprintf('TransferStore updated successfully: %s', $id));
        return $id;
    }

    /**
     * Map data to row.
     *
     * @param array<mixed> $data The data
     *
     * @return array<mixed> The row
     */
    private function mapToRow(array $data): array
    {
        $result = [];

        if (isset($data['menu_code'])) {
            $result['menu_code'] = (string)$data['menu_code'];
        }

        if (isset($data['food_menu'])) {
            $result['food_menu'] = (string)$data['food_menu'];
        }

        if (isset($data['food_type'])) {
            $result['food_type'] = (string)$data['food_type'];
        }

        if (isset($data['price'])) {
            $result['price'] = (string)$data['price'];
        }

        if (isset($data['status'])) {
            $result['status'] = (int)$data['status'];
        }

        return $result;
    }
}
