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
                            <label for="code" class="col-sm-4 col-form-label text-md-right">顧客番号</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="code" v-model="code"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label text-md-right">名前</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="name" v-model="name"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="postal_code" class="col-sm-4 col-form-label text-md-right">郵便番号</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="postal_code" v-model="postal_code"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-sm-4 col-form-label text-md-right">住所</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="address" v-model="address"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tel" class="col-sm-4 col-form-label text-md-right">電話番号</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="tel" v-model="tel"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fax" class="col-sm-4 col-form-label text-md-right">FAX</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="fax" v-model="fax"/>
                            </div>
                        </div>
                        <div class="align-self-center">
                            <input type="submit" class="btn btn-dark" @click="addCustomer" value="新規登録">
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
            id: '',
            code: '',
            name: '',
            postal_code: '',
            address: '',
            tel: '',
            fax: '',
            title: '顧客情報登録',
        }
    },
    watch: {
        //
    },
    computed: {
        //
    },
    methods: {
        onBack() {
            this.$router.push({ name: 'sample' })
        },
        addCustomer() {
            axios.post('/api/customer/store', {
                id: this.id,
                code: this.code,
                name: this.name,
                postal_code: this.postal_code,
                address: this.address,
                tel: this.tel,
                fax: this.fax,
            })
            .then(this.$router.push({ name: 'sample' }))
            .catch(error => {
                console.log(error);
            });
        },
    }
}
</script>

<style lang="scss" scoped>
@import "resources/sass/variables";
</style>