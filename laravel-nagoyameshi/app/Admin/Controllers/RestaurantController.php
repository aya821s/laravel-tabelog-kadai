<?php

namespace App\Admin\Controllers;

use App\Models\Restaurant;
use App\Models\Category;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class RestaurantController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Restaurant';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Restaurant());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('category.name', __('Category Name'));
        $grid->column('image', __('Image'))->image();
        $grid->column('name', __('Name'));
        $grid->column('description', __('Description'));
        $grid->column('opening_time', __('Opening time'))->sortable();
        $grid->column('closing_time', __('Closing time'))->sortable();
        $grid->column('lowest_price', __('Lowest price'))->sortable();
        $grid->column('highest_price', __('Highest price'))->sortable();
        $grid->column('postal_code', __('Postal code'));
        $grid->column('address', __('Address'));
        $grid->column('phone_number', __('Phone number'));
        $grid->column('holidays', __('Holidays'));
        $grid->column('created_at', __('Created at'))->sortable();
        $grid->column('updated_at', __('Updated at'))->sortable();
        
        $grid->filter(function($filter) {
            $filter->like('name', '店名');
            $filter->like('description', '説明');
            $filter->between('Lowest price', '最低金額');
            $filter->between('Highest price', '最高金額');
            $filter->in('category_id', 'カテゴリー')->multipleSelect(Category::all()->pluck('name', 'id'));
        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Restaurant::findOrFail($id));

        $show->field('id', __('Id'))->sortable();
        $show->field('name', __('Name'));
        $show->field('category.name', __('Category Name'));
        $show->field('image', __('Image'))->image();
        $show->field('description', __('Description'));
        $show->field('opening_time', __('Opening time'));
        $show->field('closing_time', __('Closing time'));
        $show->field('lowest_price', __('Lowest price'));
        $show->field('highest_price', __('Highest price'));
        $show->field('postal_code', __('Postal code'));
        $show->field('address', __('Address'));
        $show->field('phone_number', __('Phone number'));
        $show->field('holidays', __('Holidays'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Restaurant());

        $form->text('name', __('Name'));
        $form->select('category_id', __('Category Name'))->options(Category::all()->pluck('name', 'id'));
        $form->image('image', __('Image'));
        $form->textarea('description', __('Description'));
        $form->time('opening_time', __('Opening time'))->default(date('H:i:s'));
        $form->time('closing_time', __('Closing time'))->default(date('H:i:s'));
        $form->number('lowest_price', __('Lowest price'));
        $form->number('highest_price', __('Highest price'));
        $form->text('postal_code', __('Postal code'));
        $form->text('address', __('Address'));
        $form->text('phone_number', __('Phone number'));
        $form->text('holidays', __('Holidays'));

        return $form;
    }
}
