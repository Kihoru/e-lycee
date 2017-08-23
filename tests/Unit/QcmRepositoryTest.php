<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Qcm;
use App\Repositeries\QcmRepository;

class QcmRepositoryTest extends TestCase
{

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testEdit()
    {
        $qcm = new Qcm();
        $repo = new QcmRepository($qcm);
        $res = $repo->edit(18);
        dd($res);
    }
}
