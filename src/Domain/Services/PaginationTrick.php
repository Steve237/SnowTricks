<?php

namespace App\Domain\Services;

use App\Entity\Trick;
use App\Repository\TrickRepository;

final class PaginationTrick
{

    /** @var TrickRepository */
    protected $trickRepo;

    public function __construct(TrickRepository $trickRepo)
    {
        $this->trickRepo = $trickRepo;
    }

    public function getOffset(int $page): int
    {
        return is_null($page) || (int) $page === 1 ? 0 : ((int) $page - 1) * Trick::LIMIT_PER_PAGE;
    }

    public function getPages(): int
    {
        $tricks = $this->trickRepo->findAll();
        $total = count($tricks);

        return ceil($total / Trick::LIMIT_PER_PAGE);
    }
}
