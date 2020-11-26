<template>
    <div class="container-fluid">
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
                    <div class="col-sm-12 col-md-auto mt-3">
                        作業日
                        <div class="align-self-center">
                            <input type="date" class="mr-1" v-model="from_worked_on">
                            <button type="button" class="btn btn-dark btn-sm" @click="onResetFromWorkedOn">×</button>
                            ～
                            <input type="date" class="ml-1" v-model="to_worked_on">
                            <button type="button" class="btn btn-dark btn-sm" @click="onResetToWorkedOn">×</button>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-auto mt-3">ライン
                            <div class="align-self-center mx-4">
                            <select id="line_name" class="form-control" v-model="line_name">
                                <option></option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-auto mt-3">商品名　{{set_search_item_name}}
                        <div class="ml-3 mr-1 align-self-center">品番
                            <input type="text" v-model="set_search_item_code" data-toggle="modal" data-target="#search-item" readonly>
                            <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#search-item">商品検索</button>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-2 mt-3">日報検索
                        <div class="align-self-center">
                            <button type="button" class="btn btn-success col-12" @click="getDailyReports">検索</button>
                        </div>
                    </div>
                </div>
                <!-- ここからモーダルのポップアップ部分 -->
                <div class="modal fade" id="search-item" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="label1">商品検索</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="col-7 mb-3">コード：<input type="text" v-model="search_item_code" class="align-self-center"></div>
                                <div class="col-7 mb-3">商品名：<input type="text" v-model="search_item_name" class="align-self-center"></div>
                                <button type="button" class="btn btn-success align-self-center ml-1" @click="searchItems">検索</button>
                                <table class="table table-sm mt-3" key="processes">
                                    <thead>
                                        <tr>
                                            <th class="text-center bg-primary text-white">商品コード</th>
                                            <th class="text-center bg-primary text-white">商品名</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="clickable" v-for="item in items" :key="item.index" :value="item.id" @click="setItemCode(item)">
                                            <td class="text-center align-middle" >{{ item.code }}</td>
                                            <td class="text-center align-middle">{{ item.name }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="text-center align-middle">
                                    <strong>選択　コード：　</strong>{{set_search_item_code}}
                                    <strong>　商品名：　</strong>{{set_search_item_name}}
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ここまでモーダル -->
                        
                <table class="table table-sm mt-3" key="processes">
                    <thead>
                        <tr>
                            <th class="text-center bg-primary text-white">作業日</th>
                            <th class="text-center bg-primary text-white">商品名</th>
                            <th class="text-center bg-primary text-white">ライン</th>
                            <th class="text-center bg-primary text-white">作業員数</th>
                            <th class="text-center bg-primary text-white">作業時間</th>
                            <th class="text-center bg-primary text-white">良品数</th>
                            <th class="text-center bg-primary text-white">状態</th>
                        </tr>
                    </thead>

                    <tbody v-for="(daily_report, index) in daily_reports" :key="index">
                        <tr class="clickable" v-for="detail in daily_report.daily_details" :key="detail.id" @click="onShow(detail.daily_report_id)">
                            <td class="text-center align-middle">{{ detail.worked_on }}</td>
                            <td class="text-center align-middle">{{ detail.item_name }} </td>
                            <td class="text-center align-middle">{{ detail.line_name }}</td>
                            <td class="text-center align-middle">{{ detail.workers_number }}</td>
                            <td class="text-center align-middle">{{ detail.production_time }}</td>
                            <td class="text-center align-middle"> {{ detail.pass_amount }}</td>
                            <td class="text-center align-middle">{{ detail.state }}</td>
                        </tr>
                    </tbody>
                </table>
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
            search_item_code: '',
            search_item_name: '',
            set_search_item_code: '',
            set_search_item_name: '',
            set_search_item_id: '',
            items: {
                id: '',
                code: '',
                name: '',
            },
            from_worked_on: '',
            to_worked_on: '',
            line_name: '',
            daily_reports: [],
        }
    },
    mounted() {
        this.setWorkedOn()
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
        onCreate() {
            this.$router.push({ name: 'daily_report.create' })
        },
        async getDailyReports() {
            try {
                const {data} = await axios.get('/api/daily_report',{
                    params:{
                        from_worked_on: this.from_worked_on,
                        to_worked_on: this.to_worked_on,
                        line_name: this.line_name,
                        item_id: this.set_search_item_id,
                    }
                })
                this.daily_reports = data
            } catch (e) {
                console.log(error)
            }  
        },
        onShow(daily_report_id) {
            this.$router.push({ name: 'daily_report.show', params: { daily_report_id: daily_report_id }})
        },
        setWorkedOn() {
            let moment = require("moment");
            this.from_worked_on = moment().format("YYYY-MM-DD")
            this.to_worked_on = moment().format("YYYY-MM-DD")
        },
        async searchItems() {
            try {
                const {data} = await axios.get('/api/item/search_item', {
                    params: {
                        code: this.search_item_code,
                        name: this.search_item_name,
                    }
                })
                this.items = data
            } catch (e) {
                console.log(error)
            }  
        },
        setItemCode(item) {
            this.set_search_item_code = item.code
            this.set_search_item_name = item.name
            this.set_search_item_id = item.id
        },
        onResetFromWorkedOn() {
            this.from_worked_on = ''
        },
        onResetToWorkedOn() {
            this.to_worked_on = ''
        },
    },
}
</script>

<style lang="scss" scoped>
@import "resources/sass/variables";
</style>
