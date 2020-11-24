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
                    <div class="col-6">作業日</div>
                    <div class="col-2">ライン</div>
                    <div class="col-2">商品名</div>
                    <div class="col-2"></div>
                    <!-- 作業日 -->
                    <div class="col-6 align-self-center">
                        <input type="date" class="mr-1" v-model="from_worked_on">～<input type="date" class="ml-1" v-model="to_worked_on">
                    </div>
                    <!-- ライン -->
                    <div class="col-2 align-self-center">
                        <select id="line_name" class="form-control" v-model="line_name">
                            <option></option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                    <!-- 商品名 -->
                    <div class="col-2 align-self-center"><input type="text" style="width:5rem;" v-model="item_id"></div>
                    <div class="col-2 align-self-center"><button type="button" class="btn btn-success" @click="getDailyReports">検索</button></div>
                </div>
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
                    <tbody>
                        <tr class="clickable" v-for="(daily_report, index) in daily_reports" :key="index" @click="onShow(daily_report.id)">
                            <td class="text-center align-middle">{{ daily_report.worked_on }}</td>
                            <td class="text-center align-middle">
                                <div v-for="detail in daily_report.daily_details" :key="detail.id">
                                    {{ detail.item_name }}
                                </div>
                            </td>
                            <td class="text-center align-middle">{{ daily_report.line_name }}</td>
                            <td class="text-center align-middle">
                                <div v-for="detail in daily_report.daily_details" :key="detail.id">
                                    {{ detail.workers_number }}
                                </div>
                            </td>
                            <td class="text-center align-middle">
                                <div v-for="detail in daily_report.daily_details" :key="detail.id">
                                    {{ detail.production_time }}
                                </div>
                            </td>
                            <td class="text-center align-middle">
                                <div v-for="detail in daily_report.daily_details" :key="detail.id">
                                    {{ detail.pass_amount }}
                                </div>
                            </td>
                            <td class="text-center align-middle">
                                <div v-for="detail in daily_report.daily_details" :key="detail.id">
                                    {{ detail.state }}
                                </div>
                            </td>
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
            from_worked_on: '',
            to_worked_on: '',
            line_name: '',
            item_id: '',
            daily_reports: [],
        }
    },
    mounted () {
        this.setToday()
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
                        item_id: this.item_id,
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
        setToday() {
            let moment = require("moment");
            this.from_worked_on = moment().format("YYYY-MM-DD")
            this.to_worked_on = moment().format("YYYY-MM-DD")
        },
    },
}
</script>

<style lang="scss" scoped>
@import "resources/sass/variables";
</style>
