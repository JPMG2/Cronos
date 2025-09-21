<?php

declare(strict_types=1);

namespace App\Traits;

use App\Models\City;
use App\Models\Province;

trait ProvinceCity
{
    public string $stringProvince = '';

    public string $stringCity = '';

    public ?int $id_province = 0;

    public ?int $id_city = 0;

    public bool $showProvince = false;

    public bool $showCity = false;

    public $listProvince = [];

    public $listCities = [];

    public function searchProvince()
    {
        if (empty($this->stringProvince)) {
            $this->showProvince = ! empty($this->listProvince);

            return null;
        }

        $this->stringProvince = stringToTitle($this->stringProvince);
        $this->listProvince = Province::proviceSearch($this->stringProvince)->get();
        $this->showProvince = ! empty($this->listProvince);

        return $this->listProvince;
    }

    public function selectProvince(Province $province): void
    {

        $this->setProvinceId($province->id);

        $this->showProvince = false;
    }

    public function searchCity()
    {
        if ($this->getProvinceId() <= 0 || empty($this->stringCity)) {
            $this->showCity = count($this->listCities) > 0;

            return null;
        }

        $this->stringCity = stringToTitle($this->stringCity);
        $this->listCities = City::citySearch($this->getProvinceId(), $this->stringCity)->get();
        $this->showCity = count($this->listCities) > 0;

        return $this->listCities;
    }

    public function getProvinceId(): int
    {
        return is_null($this->id_province) ? 0 : $this->id_province;
    }

    public function selectCity(City $city): void
    {

        $this->setCityId($city->id);

        $this->showCity = false;

    }

    public function resetValuesProvince(): void
    {
        if (str($this->stringCity)->length() <= 0) {
            return;
        }

        $this->setProvinceId(0);
        $this->stringCity = '';
    }

    public function resetValuesCity(): void
    {
        if ($this->id_city <= 0) {
            return;
        }

        $this->setCityId(0);
        $this->stringCity = '';
    }

    public function resetAllProvince(): void
    {

        $this->setProvinceId(0);
        $this->setCityId(0);
        $this->stringProvince = '';
        $this->stringCity = '';
    }

    public function getCityId(): int
    {
        return is_null($this->id_city) ? 0 : $this->id_city;
    }

    public function getProvinceName(): string
    {
        return $this->stringProvince;
    }

    public function getCityName(): string
    {
        return $this->stringCity;
    }

    public function setLocactionNameID($provinceId, $cityId, $provinceName, $cityName): void
    {
        $this->setProvinceCity($provinceId, $cityId);
        $this->setnameProvinceCity($provinceName, $cityName);
    }

    public function setProvinceCity(?int $provinceId, ?int $cityId): void
    {
        if ($provinceId > 0) {
            $this->setProvinceId($provinceId);
        }
        if ($cityId > 0) {
            $this->setCityId($cityId);
        }
    }

    public function setnameProvinceCity(?string $province, ?string $city): void
    {
        if ($province !== null) {
            $this->stringProvince = $province;
        }
        if ($city !== null) {
            $this->stringCity = $city;
        }
    }

    private function setProvinceId(int $id): void
    {
        $this->id_province = $id;

    }

    private function setCityId(int $id): void
    {
        $this->id_city = $id;
    }

    private function dataProvince(int $id): Province
    {
        return Province::find($id);
    }
}
