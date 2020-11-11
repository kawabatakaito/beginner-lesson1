<?php

use Illuminate\Database\Seeder;
use App\Customer;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $model = new Customer;$model->name = 'user01';$model->code = '01';$model->tel = '090-1234-5678';$model->fax = '072-483-1234';$model->postal_code = '598-1234';$model->address = '大阪';$model->save();
        $model = new Customer;$model->name = 'user02';$model->code = '02';$model->tel = '090-1111-2222';$model->fax = '059-852-8520';$model->postal_code = '599-0211';$model->address = '東京';$model->save();
        $model = new Customer;$model->name = 'user03';$model->code = '03';$model->tel = '080-456-321';$model->fax = '084-753-9510';$model->postal_code = '599-5463';$model->address = '愛知';$model->save();
        $model = new Customer;$model->name = 'user04';$model->code = '04';$model->tel = '080-5555-5555';$model->fax = '021-111-2310';$model->postal_code = '599-8124';$model->address = '和歌山';$model->save();
    }
}
