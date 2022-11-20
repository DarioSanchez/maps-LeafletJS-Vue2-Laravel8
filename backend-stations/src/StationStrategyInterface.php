<?php

namespace Src;

interface StationStrategyInterface
{
        public  function list();

        public function listAll();

        public function detail(int $id);

        public function localizations();

        public function getLocalizations(int $id);
}
