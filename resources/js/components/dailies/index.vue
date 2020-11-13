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
                         <table class="table table-sm" key="processes">
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
                            <tr  class="clickable" v-for="daily in dailies" :key="daily.id">
                                <td class="text-center align-middle">{{ daily.worked_on }}</td>
                                <td class="text-center align-middle"></td>
                                <td class="text-center align-middle">{{ daily.line_name }}</td>
                                <td class="text-center align-middle"></td>
                                <td class="text-center align-middle"></td>
                                <td class="text-center align-middle"></td>
                                <td class="text-center align-middle"></td>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr  class="clickable" v-for="daily_detail in daily_details" :key="daily_detail.id">
                                <td class="text-center align-middle"></td>
                                <td class="text-center align-middle">{{ daily_detail.item_id }}</td>
                                <td class="text-center align-middle"></td>
                                <td class="text-center align-middle">{{ daily_detail.workers_number }}</td>
                                <td class="text-center align-middle">{{ daily_detail.started_on }}</td>
                                <td class="text-center align-middle">{{ daily_detail.pass_amount }}</td>
                                <td class="text-center align-middle">{{ daily_detail.state }}</td>
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
    data() {
        return {
            dailies: {
                line_name: '',
                worked_on: '',
            },
            daily_details: {
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
    },
    mounted () {
        this.getDailies()
        this.getDaily_details()
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
        },
        async getDailies() {
            axios.get('/api/daily')
            .then(response => {
                this.dailies = response.data;
            })
            .catch(error => {
                console.log(error);
            });
        },
        async getDaily_details() {
            axios.get('/api/daily_details')
            .then(response => {
                this.daily_details = response.data;
            })
            .catch(error => {
                console.log(error);
            });
        },
        getWorkedOn() {

        }
    },
}
</script>

<style lang="scss" scoped>
@import "resources/sass/variables";
</style>
