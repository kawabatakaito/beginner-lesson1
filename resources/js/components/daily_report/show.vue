<template>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-start mb-3">
                    <div class="mr-auto">
                        <span class="span-header font-bold">包装ライン日報</span>
                    </div>
                    <div class="align-self-center mr-5">
                        <button type="button" class="btn btn-success">ダウンロード</button>
                    </div>
                    <div class="align-self-center">
                        <button type="button" class="btn btn-dark" @click="onBack">戻る</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mt-4"></div>
                    <div class="align-self-center font-bold ml-3">ライン</div>
                    <div class="align-self-center">
                        <select id="line_name" class="form-control" v-model="daily_report.line_name">
                            <option></option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </div>
                    <div class="align-self-center font-bold">号機</div>
                    <div class="align-self-center ml-3 mr-1 font-bold">作業日</div>
                    <input type="date" v-model="daily_report.worked_on" class="align-self-center">
                </div>

            <!-- v-forの中の＋ボタンを押すと次のdaily_report.daily_detailを追加 -->
                <div v-for="(daily_detail, index) in daily_report.daily_details" :key="index">
                    <div class="card mt-3">
                        <div class="card-body">
                            <p>{{index + 1}}</p>
                            <div class="row">
                                <div class="col-12 mt-2"></div>
                                <div class="align-self-center ml-3 mr-1 font-bold">品番</div>
                                <input type="text" v-model="daily_detail.item_id" class="align-self-center">：{{ items.name }}
                                <div class="align-self-center ml-3 mr-1 font-bold">担当者
                                {{daily_detail.employee_id}}：{{ loginUser }}
                                </div>
                            </div>
                    
                            <div class="row">
                                <div class="col-12 mt-3"></div>
                                <div class="form-check align-self-center ml-3">
                                    <input class="form-check-input" type="checkbox" :id="'check1a-'+index+1" v-model="daily_detail.is_oxygen_scavenger">
                                    <label class="form-check-label font-bold" :for="'check1a-'+index+1">脱酸素剤</label>
                                </div>
                                <div class="form-check ml-3 align-self-center">
                                    <input class="form-check-input" type="checkbox" :id="'check1b-'+index+1" v-model="daily_detail.is_packaging_material">
                                    <label class="form-check-label font-bold" :for="'check1b-'+index+1">包装材料</label>
                                </div>
                                <div class="form-check ml-3 align-self-center">
                                    <input class="form-check-input" type="checkbox" :id="'check1c-'+index+1" v-model="daily_detail.is_filling_gas">
                                    <label class="form-check-label font-bold" :for="'check1c-'+index+1">充填ガス</label>
                                </div>
                                <div class="align-self-center mx-3 font-bold">作業員数</div>
                                <input type="number" v-model.number="daily_detail.workers_number" class="col-2 align-self-center">
                            </div>

                            <div class="row">
                                <div class="col-12 mt-3"></div>
                                <div class="col-12 font-bold">金属検出機動作確認</div>
                                <div class="form-check align-self-center ml-3">
                                    <input class="form-check-input" type="checkbox" :id="'check1a-'+index+1" v-model="daily_detail.start_metal_detector_fe_check">
                                    <label class="form-check-label font-bold" :for="'check1a-'+index+1">Fe</label>
                                </div>
                                <div class="form-check ml-3 align-self-center">
                                    <input class="form-check-input" type="checkbox" :id="'check1b-'+index+1" v-model="daily_detail.start_metal_detector_sus_check">
                                    <label class="form-check-label font-bold" :for="'check1b-'+index+1">SUS</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 mt-3"></div>
                                <div class="col-12 font-bold">X線異物検出機動作確認</div>
                                <div class="form-check align-self-center ml-3">
                                    <input class="form-check-input" type="checkbox" :id="'check1a-'+index+1" v-model="daily_detail.start_x_detector_fe_check">
                                    <label class="form-check-label font-bold" :for="'check1a-'+index+1">Fe</label>
                                </div>
                                <div class="form-check ml-3 align-self-center">
                                    <input class="form-check-input" type="checkbox" :id="'check1b-'+index+1" v-model="daily_detail.start_x_detector_sus_check">
                                    <label class="form-check-label font-bold" :for="'check1b-'+index+1">SUS</label>
                                </div>
                                <div class="form-check ml-3 align-self-center">
                                    <input class="form-check-input" type="checkbox" :id="'check1a-'+index+1" v-model="daily_detail.start_x_detector_gi_check">
                                    <label class="form-check-label font-bold" :for="'check1a-'+index+1">GI</label>
                                </div>
                                <div class="form-check ml-3 align-self-center">
                                    <input class="form-check-input" type="checkbox" :id="'check1b-'+index+1" v-model="daily_detail.start_x_detector_pvc_check">
                                    <label class="form-check-label font-bold" :for="'check1b-'+index+1">PVC</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 mt-3"></div>
                                <button type="button" class="btn btn-success btn-lg col-8 ml-3" @click="onStart(daily_detail)">作業開始</button>
                                <div class="ml-3 align-self-center time-font">{{ startTime(daily_detail.started_on) }}</div>
                            </div>

                            <div class="row">
                                <div class="col-12 mt-3"></div>
                                <div class="align-self-center mx-3 font-bold">良品数</div>
                                <input type="number" v-model.number="daily_detail.pass_amount" class="col-2 align-self-center">
                                <div class="align-self-center mx-3 font-bold">リパック数</div>
                                <input type="number" v-model.number="daily_detail.repack_amount" class="col-2 align-self-center">
                            </div>

                            <div class="row">
                                <div class="col-12 mt-3"></div>
                                <div class="col-12 font-bold">不良品数</div>
                                <div class="align-self-center mx-3 font-bold">軽量</div>
                                <input type="number" v-model.number="daily_detail.lightweight" class="col-1 align-self-center">
                                <div class="align-self-center mx-3 font-bold">外観等</div>
                                <input type="number" v-model.number="daily_detail.appearance" class="col-1 align-self-center">
                                <div class="align-self-center mx-3 font-bold">金属排除</div>
                                <input type="number" v-model.number="daily_detail.metal_removal" class="col-1 align-self-center">
                                <div class="align-self-center mx-3 font-bold">X線排除</div>
                                <input type="number" v-model.number="daily_detail.x_removal" class="col-1 align-self-center">
                            </div>

                            <div class="row">
                                <div class="col-12 mt-3"></div>
                                <button type="button" class="btn btn-danger btn-lg col-8 ml-3" @click="onFinish(daily_detail)">作業終了</button>
                                <div class="ml-3 align-self-center time-font">{{ finishTime(daily_detail.finished_on) }}</div>
                            </div>

                            <div class="row">
                                <div class="col-12 mt-3"></div>
                                <div class="col-12 font-bold">金属検出機動作確認</div>
                                <div class="form-check align-self-center ml-3">
                                    <input class="form-check-input" type="checkbox" :id="'check1a-'+index+1" v-model="daily_detail.stop_metal_detector_fe_check">
                                    <label class="form-check-label font-bold" :for="'check1a-'+index+1">Fe</label>
                                </div>
                                <div class="form-check ml-3 align-self-center">
                                    <input class="form-check-input" type="checkbox" :id="'check1b-'+index+1" v-model="daily_detail.stop_metal_detector_sus_check">
                                    <label class="form-check-label font-bold" :for="'check1b-'+index+1">SUS</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 mt-3"></div>
                                <div class="col-12 font-bold">X線異物検出機動作確認</div>
                                <div class="form-check align-self-center ml-3">
                                    <input class="form-check-input" type="checkbox" :id="'check1a-'+index+1" v-model="daily_detail.stop_x_detector_fe_check">
                                    <label class="form-check-label font-bold" :for="'check1a-'+index+1">Fe</label>
                                </div>
                                <div class="form-check ml-3 align-self-center">
                                    <input class="form-check-input" type="checkbox" :id="'check1b-'+index+1" v-model="daily_detail.stop_x_detector_sus_check">
                                    <label class="form-check-label font-bold" :for="'check1b-'+index+1">SUS</label>
                                </div>
                                <div class="form-check ml-3 align-self-center">
                                    <input class="form-check-input" type="checkbox" :id="'check1a-'+index+1" v-model="daily_detail.stop_x_detector_gi_check">
                                    <label class="form-check-label font-bold" :for="'check1a-'+index+1">GI</label>
                                </div>
                                <div class="form-check ml-3 align-self-center">
                                    <input class="form-check-input" type="checkbox" :id="'check1b-'+index+1" v-model="daily_detail.stop_x_detector_pvc_check">
                                    <label class="form-check-label font-bold" :for="'check1b-'+index+1">PVC</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 mt-3"></div>
                                <div class="align-self-center ml-3">
                                    <button type="button" class="btn btn-primary btn-sm" @click="onPlus(index)">＋</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- ここまでv-forで追加 -->

                <div class="row justify-content-between">
                    <div class="col-12 mt-4"></div>
                    <button type="button" class="btn btn-outline-danger ml-1" @click="onDelete">この日報を削除する</button>
                    <button type="button" class="btn btn-primary mr-3" @click="onUpdate('finished')" style="width: 150px;">更新する</button>
                </div>

                <button type="button" class="btn btn-success btn-state" @click="onUpdate('state')">一時保存</button>

            </div>
        </div>
    </div>
</template>

<script>
import moment from 'moment';
export default {
    props: [
        'daily_report_id',
    ],
    data() {
        return {
            message: '',
            daily_report: {
                id: '',
                line_name: '',
                worked_on: '',
                daily_details: [],
            },
            items: {
                id: '',
                code: '',
                name: '',
            },
            employees: {
                user_id: 38,
                last_name: '川畑',
            },
            default_daily_detail: {
                id: '',
                daily_report_id: '',
                item_id: '038',
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
                state: '実行前',
                is_finished: false,
            },
            user: {
                id: '',
                name: '',
                employee_id: '',
            }
        }
    },
    mounted () {
        this.getUser()
        this.getDailyReport()
        this.getItem()
        this.getEmployee()
    },
    watch: {
        //
    },
    computed: {
        loginUser() {
            var user = this.$store.state.user
            if (!user.employee) {
                return user.name
            }
            return user.employee.last_name + ' ' + user.employee.first_name
        },
    },
    methods: {
            // ↓　axios.create()なしでは＋ボタン反応しない--axios.create()を使うことでリクエストのインスタンスを作ることもできる。引数には設定を渡すことができる。
        async getDailyReport() {
            try {
                const {data} = await axios.create().get('/api/daily_report/'+this.daily_report_id, this.daily_report_id)
                this.daily_report = data
            } catch(e) {
                console.log(error)
            }
        },
        getUser() {
            this.default_daily_detail.employee_id =  this.$store.state.user.employee_id
        },
        onBack() {
            this.$router.push({ name: 'daily_report' })
        },
        getItem() {
            this.items
        },
        getEmployee() {
            this.employees
        },
        onStart(daily_detail) { 
            daily_detail.state = '実行中'
            daily_detail.started_on = moment().format("HH:mm")
        },
        onFinish(daily_detail) { 
            daily_detail.state = '完了'
            return daily_detail.finished_on = moment().format("HH:mm")
        },
        onPlus(index) {
            this.daily_report.daily_details.splice(index + 1, 0, _.cloneDeep(this.default_daily_detail))
        },
        onDelete() {
            if (!confirm('このデータを削除しますか？')) {
                return
            }
            axios.post('/api/daily_report/'+this.daily_report_id, { _method: 'delete' })
            .then(alert('データを削除しました・・・'),this.$router.push({ name: 'daily_report' }))
            .catch(function (error) {
                console.log(error);
            })
        },
        onUpdate(status) {
            if (status == 'state') {
                if (!confirm('一時保存データを更新しますか？')) {
                    return
                }
                this.message = '一時保存データを更新しました'
            } else if (status == 'finished') {
                if (!confirm('このデータを更新しますか？')) {
                    return
                }
                this.message = 'データを更新しました'
            }
            axios.post('/api/daily_report/'+this.daily_report_id, { daily_report: this.daily_report, _method: 'put'})
            .then(alert(this.message),this.$router.push({ name: 'daily_report' }))
            .catch(function (error) {
                console.log(error);
            });
        },
        startTime(time) {
            // そのままだと"HH:mm:ss"形式なるので、timeをDate型にしてから再度"HH:mm"形式に変換
            let change = moment().format("YYYY/MM/DD ")+time
            return moment(change).format("HH:mm")
        },
        finishTime(time) {
            let change = moment().format("YYYY/MM/DD ")+time
            return moment(change).format("HH:mm")
        },
    },
}
</script>

<style lang="scss" scoped>
@import "resources/sass/variables";
.btn-state{
	position: fixed;
    right: 30px;
    bottom: 30px;
    width: 150px;
}
.time-font {
    font-size: 2rem;
}
.font-bold {
    font-weight: bold;
}
</style>