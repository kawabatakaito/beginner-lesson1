<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-start mb-3">
                        <div class="mr-auto">
                            <span class="span-header">Lesson 9</span>
                        </div>
                        <div class="align-self-center">
                            <button type="button" class="btn btn-dark" @click="onBack">戻る</button>
                        </div>
                    </div>
                    
                    <div class="quesion-header">Laravel + Vue.js CRUD</div>
                    <p>
                        Lesson 7 で作成したテーブルcustomers のCRUD機能の実装<br>
                        ・customersの一覧表示<br>
                        ・customersの新規作成<br>
                        ・customersの編集<br>
                        ・customersの削除<br>
                    </p>
                    <div class="align-self-center mb-3">
                        <button type="button" class="btn btn-dark" @click="onCreate">新規登録</button>
                    </div>
                    <table class="table table-sm" key="processes">
                        <thead>
                            <tr>
                                <th class="text-center bg-primary text-white">id</th>
                                <th class="text-center bg-primary text-white">お客様番号</th>
                                <th class="text-center bg-primary text-white">名前</th>
                                <th class="text-center bg-primary text-white">郵便番号</th>
                                <th class="text-center bg-primary text-white">住所</th>
                                <th class="text-center bg-primary text-white">電話番号</th>
                                <th class="text-center bg-primary text-white">FAX</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr  class="clickable" v-for="customer in customers" :key="customer.id" @click="onShow(customer.id)">
                                <td class="text-center align-middle">{{ customer.id }}</td>
                                <td class="text-center align-middle">{{ customer.code }}</td>
                                <td class="text-center align-middle">{{ customer.name }}</td>
                                <td class="text-center align-middle">{{ customer.postal_code }}</td>
                                <td class="text-center align-middle">{{ customer.address }}</td>
                                <td class="text-center align-middle">{{ customer.tel }}</td>
                                <td class="text-center align-middle">{{ customer.fax }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: {
        //
    },
    data () {
        return {
            customers: [],
        }
    },
    mounted () {
        this.getCustomer()
    },
    watch: {
        //
    },
    computed: {
        //
    },
    methods: {
        onBack() {
            this.$router.push({ name: 'home' })
        },
        async getCustomer() {
            axios.get('/api/customer')
            .then(response => {
                this.customers = response.data;
            })
            .catch(error => {
                console.log(error);
            });
        },
        onShow(customer_id) {
            this.$router.push({ name: 'sample.show', params: { customer_id: customer_id }})
        },
        onCreate() {
            this.$router.push({ name: 'sample.create'})
        },
    }
}
</script>

<style lang="scss" scoped>
@import "resources/sass/variables";
</style>