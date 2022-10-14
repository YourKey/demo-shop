<?php

namespace Tests\Feature;

use App\Filters\CheckboxFilter;
use App\Filters\Filters;
use App\Filters\InputFilter;
use App\Filters\InputRangeFilter;
use App\Filters\RadioFilter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\View;
use Tests\CreatesApplication;
use Tests\TestCase;

class FiltersTest extends TestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_base()
    {
        $filters = new Filters();

        $filters->registerFilters(
            (array) InputFilter::make('Label', 'field_name'),
        );

        $this->assertNotEmpty($filters->all());
    }

    public function test_input_filter()
    {
        $filter = InputFilter::make('Label', 'field_name');

        $this->assertEquals('Label', $filter->label());
        $this->assertEquals('field_name', $filter->field());
        $this->assertEquals('filters_field_name', $filter->id());
        $this->assertEquals('filters[field_name]', $filter->name());
        $this->assertNull($filter->requestValue());
        $this->assertNull($filter->relatedField());
        $this->assertEquals('input', $filter->view());
        $this->assertTrue(View::exists("filters.{$filter->view()}"));

        request()->merge([
            'filters' => ['field_name' => 'value']
        ]);

        $this->assertEquals('value', $filter->requestValue());
    }

    public function test_checkbox_filter()
    {
        $filter = CheckboxFilter::make('Label', 'field_name')->multiply();

        $this->assertTrue($filter->isMultiply());
        $this->assertEquals('checkbox', $filter->type());
        $this->assertEquals('Label', $filter->label());
        $this->assertEquals('field_name', $filter->field());
        $this->assertEquals('filters_field_name', $filter->id());
        $this->assertEquals('filters[field_name][]', $filter->name());
        $this->assertNull($filter->requestValue());
        $this->assertNull($filter->relatedField());
        $this->assertEquals('checkbox', $filter->view());
        $this->assertTrue(View::exists("filters.{$filter->view()}"));

        request()->merge([
            'filters' => ['field_name' => 'value']
        ]);

        $this->assertEquals('value', $filter->requestValue());
    }

    public function test_radio_filter()
    {
        $filter = RadioFilter::make('Label', 'field_name');

        $this->assertFalse($filter->isMultiply());
        $this->assertEquals('radio', $filter->type());
        $this->assertEquals('Label', $filter->label());
        $this->assertEquals('field_name', $filter->field());
        $this->assertEquals('filters_field_name', $filter->id());
        $this->assertEquals('filters[field_name]', $filter->name());
        $this->assertNull($filter->requestValue());
        $this->assertNull($filter->relatedField());
        $this->assertEquals('radio', $filter->view());
        $this->assertTrue(View::exists("filters.{$filter->view()}"));

        request()->merge([
            'filters' => ['field_name' => 'value']
        ]);

        $this->assertEquals('value', $filter->requestValue());
    }

    public function test_input_range_filter()
    {
        $filter = InputRangeFilter::make('Label', 'field_name', null, ['min' => 1, 'max' => 100, 'step' => 1])
            ->attributes(['min' => 1, 'max' => 100, 'step' => 1]);

        $this->assertFalse($filter->isMultiply());
        $this->assertEquals('number', $filter->type());
        $this->assertEquals('Label', $filter->label());
        $this->assertEquals('field_name', $filter->field());
        $this->assertEquals('filters_field_name', $filter->id());
        $this->assertEquals('filters[field_name]', $filter->name());
        $this->assertNull($filter->requestValue());
        $this->assertNull($filter->relatedField());
        $this->assertEquals('input_range', $filter->view());
        $this->assertTrue(View::exists("filters.{$filter->view()}"));

        request()->merge([
                             'filters' => ['field_name' => 'value']
                         ]);

        $this->assertEquals('value', $filter->requestValue());
        $this->assertEquals(1, $filter->attribute('min'));
        $this->assertEquals(100, $filter->attribute('max'));
        $this->assertEquals(1, $filter->attribute('step'));
        $this->assertTrue($filter->hasValues());

    }


}
