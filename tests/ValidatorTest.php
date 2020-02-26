<?php

namespace EllisIO\Tests\Phone;

use InvalidArgumentException;
use Illuminate\Support\Facades\Validator;

class ValidatorTest extends AbstractTestCase
{
    public function testValidatePhone()
    {
        $validator = $this->getValidator('4153902337', 'phone');

        $this->assertTrue($validator->passes());
    }

    public function testValidatePhoneFails()
    {
        $lang = $this->app->translator->get('phone::validation');

        $validator = $this->getValidator('415390233', 'phone');

        $this->assertTrue($validator->fails());
        $this->assertSame(str_replace(':attribute', 'phone', $lang['phone']), $validator->errors()->first('phone'));
    }

    public function testValidatePhoneCountry()
    {
        $validator = $this->getValidator('4153902337', 'phone_country:US');

        $this->assertTrue($validator->passes());
    }

    public function testValidatePhoneCountryFails()
    {
        $lang = $this->app->translator->get('phone::validation');

        $validator = $this->getValidator('415390233', 'phone_country:US');

        $this->assertTrue($validator->fails());
        $this->assertSame(
            str_replace([':attribute', ':types'], ['phone', 'US'], $lang['phone_country']),
            $validator->errors()->first('phone')
        );
    }

    public function testValidatePhoneCountryFailsWithForeignNumber()
    {
        $lang = $this->app->translator->get('phone::validation');

        $validator = $this->getValidator('4412345678', 'phone_country:US');

        $this->assertTrue($validator->fails());
        $this->assertSame(
            str_replace([':attribute', ':types'], ['phone', 'US'], $lang['phone_country']),
            $validator->errors()->first('phone')
        );
    }

    public function testValidatePhoneCountryCanada()
    {
        $validator = $this->getValidator('4165550150', 'phone_country:US,CA');

        $this->assertTrue($validator->passes());
    }

    public function testValidatePhoneCountryCanadaFails()
    {
        $lang = $this->app->translator->get('phone::validation');

        $validator = $this->getValidator('4412345678', 'phone_country:US,CA');

        $this->assertTrue($validator->fails());
        $this->assertSame(
            str_replace([':attribute', ':types'], ['phone', 'US,CA'], $lang['phone_country']),
            $validator->errors()->first('phone')
        );
    }

    public function testValidatePhoneCountryParamsLessThanZero()
    {
        $this->expectException(InvalidArgumentException::class);
        $validator = $this->getValidator('4153902337', 'phone_country');
        $this->assertTrue($validator->passes());
    }

    /**
     * @return \Illuminate\Validation\Validator
     */
    protected function getValidator($phone, $rules)
    {
        return Validator::make([
            'phone' => $phone,
        ], [
            'phone' => $rules,
        ]);
    }
}
