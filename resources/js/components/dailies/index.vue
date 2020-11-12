<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-start mb-3">
                            <div class="mr-auto">
                                <span class="span-header">包装ライン日報一覧</span>
                            </div>
                            <div class="align-self-center mr-5">
                                <button type="button" class="btn btn-primary" @click="onCreate">新規作成</button>
                            </div>
                            <div class="align-self-center">
                                <button type="button" class="btn btn-dark" @click="onBack">戻る</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">作業日</div>
                            <div class="col-2">ライン</div>
                            <div class="col-2">商品名</div>
                            <div class="col-2"></div>

                            <div class="col-6 align-self-center">
                                <input type="date" class="mr-1">～<input type="date" class="ml-1">
                            </div>
                            <div class="col-2 align-self-center">
                                <select id="line_name" class="form-control">
                                    <option></option>
                                    <option>1</option>
                                    <option>2</option>
                                </select>
                            </div>
                            <div class="col-2 align-self-center"><input type="text" style="width:5rem;"></div>
                            <div class="col-2 align-self-center"><button type="button" class="btn btn-success">検索</button></div>
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
        //
    },
    mounted () {
        //
    },
    watch: {
        //
    },
    methods: {
        onBack() {
            this.$router.push({ name: 'home' })
        },
        onCreate() {
            this.$router.push({ name: 'daily.create' })
        }
    },
}
</script>

<style lang="scss" scoped>
@import "resources/sass/variables";
</style>
