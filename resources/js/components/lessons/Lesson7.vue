<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-start mb-3">
                        <div class="mr-auto">
                            <span class="span-header">Lesson 7</span>
                        </div>
                        <div class="align-self-center">
                            <button type="button" class="btn btn-dark" @click="onBack">戻る</button>
                        </div>
                    </div>
                    
                    <div class="quesion-header">１．LaravelでAPIを作ってデータを表示する</div>
                    <p>
                        API <code>axios.get('/api/lesson/selector')</code> を使ってコントローラからデータを取得する。<br>
                        参考：<br>
                        テーブル定義：https://drive.google.com/drive/folders/1PMy8UwOmx3UN1b0nrGJSVlXofXZReBVO<br>
                        database-design_lesson.html（商品）<br>
                    </p>
                    <div class="alert alert-info" role="alert">
                        <i class="far fa-lightbulb"></i> ヒント: Laravel側（バックエンド）のエラーは「storage\logs」に出力されます。 <br>
                    </div>
                    <h3>店舗情報</h3>
                    <div v-for="shop in results" :key="shop.index">
                        <p>ID：{{ shop.id }}</p>
                        <p>名前：{{ shop.name }}</p>
                        <p>コード：{{ shop.code }}</p>
                        <p>電話番号：{{ shop.phonetic_name }}</p>
                    </div>

                    <hr>
                    <div class="quesion-header">２．新規テーブル（customers）を作成してそのデータを画面に表示しましょう</div>
                    <p>
                        参考：<br>
                        テーブル定義：https://drive.google.com/drive/folders/1PMy8UwOmx3UN1b0nrGJSVlXofXZReBVO<br>
                        database-design_lesson.html（顧客）<br>
                        テーブル定義を参考にテーブルを作成する。<br>
                    </p>
                    <div class="mb-3">
                        <div class="h5">１．テーブル（マイグレーションファイル）を作成する</div>
                        コマンド：<code>php artisan make:migration create_customers_table</code>
                    </div>
                    <div class="mb-3">
                        <div class="h5">２．シーダーを作成する</div>
                        コマンド：<code>php artisan make:seeder CustomersTableSeeder</code>
                    </div>
                    <div class="mb-3">
                        <div class="h5">３．モデルを作成する</div>
                        コマンド：<code>php artisan make:model Customer</code>
                    </div>
                    <div class="mb-3">
                        <div class="h5">４．コントローラーを作成する</div>
                        コマンド：<code>php artisan make:controller API/CustomerController --api</code>
                    </div>
                    <div class="mb-3">
                        <div class="h5">５．APIのルーティングを作成する</div>
                        routes\api.phpに <code>Route::get('customer', 'API\CustomerController@index');</code> を定義
                    </div>
                    
                    <h3>顧客情報</h3>
                    <div v-for="item in items" :key="item.index">
                        <p>ID：{{ item.id }}</p>
                        <p>コード：{{ item.code }}</p>
                        <p>名前：{{ item.name }}</p>
                        <p>郵便番号：{{ item.postal_code }}</p>
                        <p>住所：{{ item.address }}</p>
                        <p>電話番号：{{ item.tel }}</p>
                        <p>FAX：{{ item.fax }}</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: {

    },
    data () {
        return {
            results: null,
            items: null,
        }
    },
    mounted () {
        this.getInit()
        this.getData()
    },
    watch: {
        //
    },
    computed: {
        //
    },
    methods: {
        async getInit() {
            // LaravelでのAPIの作成
            // routes/api.phpにルーティングを設定する
            // Route::get('lesson/selector', 'API\LessonController@index');
            // ↑これがControllerとの紐づけ定義
            const {data} = await axios.get('/api/lesson/selector')
            this.results = data
        },
        async getData() {
            // const {customer} = await axios.get('/api/customer')
            // this.items = customer
            axios.get('/api/customer')
            .then(response => {
                this.items = response.data;
            })
            .catch(error => {
                console.log(error);
            });
        },
        onBack() {
            this.$router.push({ name: 'home' })
        }
    },

}
</script>

<style lang="scss" scoped>
@import "resources/sass/variables";
</style>