<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" key="admin">
                <div class="card-body">
                    <div class="d-flex justify-content-start mb-3">
                        <div class="mr-auto">
                            <span class="span-header">{{title}}</span>
                        </div>
                        <div class="align-self-center">
                            <button type="button" class="btn btn-dark" @click="onBack">戻る</button>
                        </div>
                    </div>
                    <form>
                        <div class="form-group required-label row">
                            <label for="id" class="col-sm-4 col-form-label text-md-right">ID</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="id" v-model="customer.id"/>
                            </div>
                        </div>
                        <div class="form-group required-label row">
                            <label for="code" class="col-sm-4 col-form-label text-md-right">顧客番号</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="code" v-model="customer.code"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label text-md-right">名前</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="name" v-model="customer.name"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="postal_code" class="col-sm-4 col-form-label text-md-right">郵便番号</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="postal_code" v-model="customer.postal_code"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-sm-4 col-form-label text-md-right">住所</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="address" v-model="customer.address"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tel" class="col-sm-4 col-form-label text-md-right">電話番号</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="tel" v-model="customer.tel"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fax" class="col-sm-4 col-form-label text-md-right">FAX</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="fax" v-model="customer.fax"/>
                            </div>
                        </div>
                        <div class="d-flex justify-content-start mt-4">
                            <div class="mr-auto">
                                <button type="button" class="btn btn-outline-danger" @click="onDelete">顧客情報を削除する</button>
                            </div>
                            <div class="mr-5">
                                <button type="button" class="btn btn-dark" @click="onUpdate">顧客情報を更新する</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: [
        'customer_id',
    ],
    data () {
        return {
            customer: {
                id: '',
                code: '',
                name: '',
                postal_code: '',
                address: '',
                tel: '',
                fax: '',
            },
            title: '顧客情報',
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
            this.$router.push({ name: 'lesson9' })
        },
        async getCustomer() {
            axios.get('/api/customer/'+this.customer_id, this.customer_id)
            .then(response => {
                this.customer = response.data;
            })
            .catch(error => {
                console.log(error);
            });
        },
        onDelete() {
            if (!confirm('このデータを削除しますか？')) {
                return
            }
            if (!confirm('このデータを本当に削除しますか？')) {
                return
            }
            if (!confirm('本当に削除しますよ？')) {
                return
            }
            axios.post('/api/customer/'+this.customer_id, { _method: 'delete' })
            .then(alert('データを削除しました・・・'),this.$router.push({ name: 'lesson9' }))
            .catch(function (error) {
                console.log(error);
            })
        },
        onUpdate() {
            if (!confirm('データを更新しますか？')) {
                return
            }
            axios.post('/api/customer/'+this.customer_id, { customer: this.customer, _method: 'put'})
            .then(alert('データを更新しました！'),this.$router.push({ name: 'lesson9' }))
            .catch(function (error) {
                console.log(error);
            })

        },
    }
}
</script>

<style lang="scss" scoped>
@import "resources/sass/variables";
</style>