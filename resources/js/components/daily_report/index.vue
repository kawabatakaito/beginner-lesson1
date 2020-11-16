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

                    <div class="col-6 align-self-center">
                        <input type="date" class="mr-1" v-model="today">～<input type="date" class="ml-1" v-model="today">
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
                    <tr  class="clickable" v-for="daily_report in daily_reports" :key="daily_report.id" @click="onShow(daily_report.id)">
                        <td class="text-center align-middle">{{ daily_report.worked_on }}</td>
                        <td class="text-center align-middle" v-if="daily_report.daily_detail">{{ daily_report.daily_detail.item_id }}</td>
                        <td class="text-center align-middle">{{ daily_report.line_name }}</td>
                        <td class="text-center align-middle" v-if="daily_report.daily_detail">{{ daily_report.daily_detail.workers_number }}</td>
                        <td class="text-center align-middle" v-if="daily_report.daily_detail">{{ daily_report.daily_detail.started_on }}</td>
                        <td class="text-center align-middle" v-if="daily_report.daily_detail">{{ daily_report.daily_detail.pass_amount }}</td>
                        <td class="text-center align-middle" v-if="daily_report.daily_detail">{{ daily_report.daily_detail.state }}</td>
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
            today: '',
            daily_reports: {
                line_name: '',
                worked_on: '',
            daily_detail: {
                item_id: '',
                employee_id: '',
                is_oxygen_scavenger: false,
                is_packaging_material: false,
                is_filling_gas: false,
                workers_number: '',
                start_metal_detector_fe_check: false,
                start_metal_detector_sus_check: false,
                start_x_detector_fe_check: false,
                start_x_detector_sus_check: false,
                start_x_detector_gi_check: false,
                start_x_detector_pvc_check: false,
                started_on: '00:00',
                finished_on: '00:00',
                pass_amount: '',
                repack_amount: '',
                lightweight: '',
                appearance: '',
                metal_removal: '',
                x_removal: '',
                stop_metal_detector_fe_check: false,
                stop_metal_detector_sus_check: false,
                stop_x_detector_fe_check: false,
                stop_x_detector_sus_check: false,
                stop_x_detector_gi_check: false,
                stop_x_detector_pvc_check: false,
                state: '',
                is_finished: false,
            },
            }
        }
    },
    mounted () {
        this.getDailyReports()
        this.setToday()
    },
    watch: {
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
            axios.get('/api/daily_report')
            .then(response => {
                this.daily_reports = response.data;
            })
            .catch(error => {
                console.log(error);
            });
        },
        onShow(daily_report_id) {
            this.$router.push({ name: 'daily_report.show', params: { daily_report_id: daily_report_id }})
        },
        setToday() {
            let moment = require("moment");
            return this.today = moment().format("YYYY-MM-DD")
        },
    },
}
</script>

<style lang="scss" scoped>
@import "resources/sass/variables";
</style>
