<?php

namespace CodeProject\Presenters;

use CodeProject\Transformers\ProjectTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

class ClientPresenter extends FractalPresenter
{

	public function getTransformer()
	{
		return new ClientTransformer();
	}

    public function presenter()
    {
        return ClientPresenter::class;
    }
}