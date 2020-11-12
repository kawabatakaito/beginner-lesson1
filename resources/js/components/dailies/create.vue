<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-start mb-3">
                            <div class="mr-auto">
                                <span class="span-header">包装ライン日報</span>
                            </div>
                            <div class="align-self-center mr-5">
                                <button type="button" class="btn btn-success" @click="onBack">ダウンロード</button>
                            </div>
                            <div class="align-self-center">
                                <button type="button" class="btn btn-dark" @click="onBack">戻る</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 align-self-center">ライン</div>
                            <div class="col-2 align-self-center">
                                <select id="line_name" class="form-control" v-model="dailies.line_name">
                                    <option></option>
                                    <option>1</option>
                                    <option>2</option>
                                </select>
                            </div>
                            <div class="col-2 align-self-center">号機</div>

                            <div class="col-2 align-self-center ml-3">作業日</div>
                            <input type="text" v-model="dailies.worked_on" class="col-3 align-self-center" readonly>
                        </div>
                        <div class="mt-5">
                            <p>デバッグ用</p>
                            <p>{{dailies.line_name}}</p>
                            <p>{{dailies.worked_on}}</p>
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
    data() {
        return {
            dailies: {
                line_name: '',
                worked_on: '',
            },
        }
    },
    mounted () {
        this.getDaily()
        this.setToday()
    },
    watch: {
        //
    },
    computed: {

    },
    methods: {
        onBack() {
            this.$router.push({ name: 'daily' })
        },
        getDaily() {
            return this.dailies.line_name
        },
        setToday() {
            let today=new Date();
            let year = today.getFullYear();
            let month = today.getMonth()+1;
            let week = today.getDay();
            let day = today.getDate();
            return this.dailies.worked_on = year + '/' + month + '/' + day;
        }
    },
}
</script>

<style lang="scss" scoped>
@import "resources/sass/variables";
</style>