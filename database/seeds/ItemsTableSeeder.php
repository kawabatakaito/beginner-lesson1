<?php

use Illuminate\Database\Seeder;
use App\Item;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $model = new Item;$model->name = 'user01';$model->code = '01';$model->phonetic_name = '090-1234-5678';$model->save();
        $model = new Item;$model->name = 'user02';$model->code = '02';$model->phonetic_name = '090-1111-2222';$model->save();
        $model = new Item;$model->name = 'user03';$model->code = '03';$model->phonetic_name = '080-456-321';$model->save();
        $model = new Item;$model->name = 'user04';$model->code = '04';$model->phonetic_name = '080-5555-5555';$model->save();
    }
}
