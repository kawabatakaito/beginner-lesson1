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
                    <input type="text" v-model="daily_report.worked_on" class="align-self-center" readonly>
                </div>
                <div class="row">
                    <div class="col-12 mt-3"></div>
                    <div class="align-self-center ml-3 mr-1 font-bold">品番</div>
                    <input type="text" v-model="daily_report.daily_detail.item_id" class="align-self-center">
                    <div class="align-self-center ml-3 mr-1 font-bold">担当者</div>
                    <input type="text" v-model="daily_report.daily_detail.employee_id" class="align-self-center" readonly>
                </div>

                <div class="collapse" id="example-1">
                    <div class="row">
                        <div class="col-12 mt-3"></div>
                        <div class="form-check align-self-center ml-3">
                            <input class="form-check-input" type="checkbox" id="check1a" v-model="daily_report.daily_detail.is_oxygen_scavenger">
                            <label class="form-check-label font-bold" for="check1a">脱酸素剤</label>
                        </div>
                        <div class="form-check ml-3 align-self-center">
                            <input class="form-check-input" type="checkbox" id="check1b" v-model="daily_report.daily_detail.is_packaging_material">
                            <label class="form-check-label font-bold" for="check1b">包装材料</label>
                        </div>
                        <div class="form-check ml-3 align-self-center">
                            <input class="form-check-input" type="checkbox" id="check1c" v-model="daily_report.daily_detail.is_filling_gas">
                            <label class="form-check-label font-bold" for="check1c">充填ガス</label>
                        </div>
                        <div class="align-self-center mx-3 font-bold">作業員数</div>
                        <input type="number" v-model.number="daily_report.daily_detail.workers_number" class="col-2 align-self-center">
                    </div>

                    <div class="row">
                        <div class="col-12 mt-3"></div>
                        <div class="col-12 font-bold">金属検出機動作確認</div>
                        <div class="form-check align-self-center ml-3">
                            <input class="form-check-input" type="checkbox" id="check1a" v-model="daily_report.daily_detail.start_metal_detector_fe_check">
                            <label class="form-check-label font-bold" for="check1a">Fe</label>
                        </div>
                        <div class="form-check ml-3 align-self-center">
                            <input class="form-check-input" type="checkbox" id="check1b" v-model="daily_report.daily_detail.start_metal_detector_sus_check">
                            <label class="form-check-label font-bold" for="check1b">SUS</label>
                        </div>
                    </div>

                        <div class="row">
                        <div class="col-12 mt-3"></div>
                        <div class="col-12 font-bold">X線異物検出機動作確認</div>
                        <div class="form-check align-self-center ml-3">
                            <input class="form-check-input" type="checkbox" id="check1a" v-model="daily_report.daily_detail.start_x_detector_fe_check">
                            <label class="form-check-label font-bold" for="check1a">Fe</label>
                        </div>
                        <div class="form-check ml-3 align-self-center">
                            <input class="form-check-input" type="checkbox" id="check1b" v-model="daily_report.daily_detail.start_x_detector_sus_check">
                            <label class="form-check-label font-bold" for="check1b">SUS</label>
                        </div>
                        <div class="form-check ml-3 align-self-center">
                            <input class="form-check-input" type="checkbox" id="check1a" v-model="daily_report.daily_detail.start_x_detector_gi_check">
                            <label class="form-check-label font-bold" for="check1a">GI</label>
                        </div>
                        <div class="form-check ml-3 align-self-center">
                            <input class="form-check-input" type="checkbox" id="check1b" v-model="daily_report.daily_detail.start_x_detector_pvc_check">
                            <label class="form-check-label font-bold" for="check1b">PVC</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 mt-3"></div>
                        <button type="button" class="btn btn-success btn-lg col-8 ml-3" @click="onStart">作業開始</button>
                        <div class="ml-3 align-self-center time-font">{{ daily_report.daily_detail.started_on }}</div>
                    </div>

                    <div class="row">
                        <div class="col-12 mt-3"></div>
                        <div class="align-self-center mx-3 font-bold">良品数</div>
                        <input type="number" v-model.number="daily_report.daily_detail.pass_amount" class="col-2 align-self-center">
                        <div class="align-self-center mx-3 font-bold">リパック数</div>
                        <input type="number" v-model.number="daily_report.daily_detail.repack_amount" class="col-2 align-self-center">
                    </div>

                    <div class="row">
                        <div class="col-12 mt-3"></div>
                        <div class="col-12 font-bold">不良品数</div>
                        <div class="align-self-center mx-3 font-bold">軽量</div>
                        <input type="number" v-model.number="daily_report.daily_detail.lightweight" class="col-1 align-self-center">
                        <div class="align-self-center mx-3 font-bold">外観等</div>
                        <input type="number" v-model.number="daily_report.daily_detail.appearance" class="col-1 align-self-center">
                        <div class="align-self-center mx-3 font-bold">金属排除</div>
                        <input type="number" v-model.number="daily_report.daily_detail.metal_removal" class="col-1 align-self-center">
                        <div class="align-self-center mx-3 font-bold">X線排除</div>
                        <input type="number" v-model.number="daily_report.daily_detail.x_removal" class="col-1 align-self-center">
                    </div>

                    <div class="row">
                        <div class="col-12 mt-3"></div>
                        <button type="button" class="btn btn-danger btn-lg col-8 ml-3" @click="onFinish">作業終了</button>
                        <div class="ml-3 align-self-center time-font">{{ daily_report.daily_detail.finished_on }}</div>
                    </div>

                    <div class="row">
                        <div class="col-12 mt-3"></div>
                        <div class="col-12 font-bold">金属検出機動作確認</div>
                        <div class="form-check align-self-center ml-3">
                            <input class="form-check-input" type="checkbox" id="check1a" v-model="daily_report.daily_detail.stop_metal_detector_fe_check">
                            <label class="form-check-label font-bold" for="check1a">Fe</label>
                        </div>
                        <div class="form-check ml-3 align-self-center">
                            <input class="form-check-input" type="checkbox" id="check1b" v-model="daily_report.daily_detail.stop_metal_detector_sus_check">
                            <label class="form-check-label font-bold" for="check1b">SUS</label>
                        </div>
                    </div>

                        <div class="row">
                        <div class="col-12 mt-3"></div>
                        <div class="col-12 font-bold">X線異物検出機動作確認</div>
                        <div class="form-check align-self-center ml-3">
                            <input class="form-check-input" type="checkbox" id="check1a" v-model="daily_report.daily_detail.stop_x_detector_fe_check">
                            <label class="form-check-label font-bold" for="check1a">Fe</label>
                        </div>
                        <div class="form-check ml-3 align-self-center">
                            <input class="form-check-input" type="checkbox" id="check1b" v-model="daily_report.daily_detail.stop_x_detector_sus_check">
                            <label class="form-check-label font-bold" for="check1b">SUS</label>
                        </div>
                        <div class="form-check ml-3 align-self-center">
                            <input class="form-check-input" type="checkbox" id="check1a" v-model="daily_report.daily_detail.stop_x_detector_gi_check">
                            <label class="form-check-label font-bold" for="check1a">GI</label>
                        </div>
                        <div class="form-check ml-3 align-self-center">
                            <input class="form-check-input" type="checkbox" id="check1b" v-model="daily_report.daily_detail.stop_x_detector_pvc_check">
                            <label class="form-check-label font-bold" for="check1b">PVC</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 mt-3"></div>
                    <div class="align-self-center ml-3">
                        <button type="button" class="btn btn-primary btn-sm"
                            data-toggle="collapse"
                            data-target="#example-1"
                            aria-expand="false"
                            aria-controls="example-1">＋</button>
                    </div>
                </div>

                <div class="row justify-content-between">
                    <div class="col-12 mt-4"></div>
                    <button type="button" class="btn btn-outline-danger ml-1" @click="onDelete">この日報を削除する</button>
                    <button type="button" class="btn btn-primary mr-3" @click="onUpdate('finished')" style="width: 150px;">更新する</button>
                </div>

                <button type="button" class="btn btn-success btn-state" @click="onUpdate('state')">一時保存</button>

                <div class="mt-5"></div>
                    <div class="row">
                        <div class="col-12 mt-3"></div>
                        <div class="align-self-center">
                            <button type="button" class="btn btn-primary btn-sm"
                                data-toggle="collapse"
                                data-target="#example-2"
                                aria-expand="false"
                                aria-controls="example-2">デバック</button>
                        </div>
                    </div>

                <div class="collapse" id="example-2">
                    <div class="mt-5"></div>
                    <p>ライン名：{{daily_report.line_name}}　　作業日：{{daily_report.worked_on}}</p>
                    <p>品番：{{daily_report.daily_detail.code}}　　担当者：{daily_report.daily_detail..last_name}}</p>
                    <p>脱酸素剤：{{daily_report.daily_detail.is_oxygen_scavenger}}　包装材料：{{daily_report.daily_detail.is_packaging_material}}　充填ガス：{{daily_report.daily_detail.is_filling_gas}}　作業員数：{{daily_report.daily_detail.workers_number}}</p>
                    <p>金属検出機動作確認</p>
                    <p>Fe：{{daily_report.daily_detail.start_metal_detector_fe_check}}　SUS：{{daily_report.daily_detail.start_metal_detector_sus_check}}</p>
                    <p>X線異物検出機動作確認</p>
                    <p>Fe：{{daily_report.daily_detail.start_x_detector_fe_check}}　SUS：{{daily_report.daily_detail.start_x_detector_sus_check}}　GI：{{daily_report.daily_detail.start_x_detector_gi_check}}　PVC：{{daily_report.daily_detail.start_x_detector_pvc_check}}</p>
                    <p>作業開始：{{daily_report.daily_detail.started_on}}　作業終了：{{daily_report.daily_detail.finished_on}}</p>
                    <p>良品数：{{daily_report.daily_detail.pass_amount}}　リパック数：{{daily_report.daily_detail.repack_amount}}</p>
                    <p>不良品数</p>
                    <p>軽量：{{daily_report.daily_detail.lightweight}}　外観等：{{daily_report.daily_detail.appearance}}　金属排除：{{daily_report.daily_detail.metal_removal}}　X線排除：{{daily_report.daily_detail.x_removal}}</p>
                    <p>金属検出機動作確認</p>
                    <p>Fe：{{daily_report.daily_detail.stop_metal_detector_fe_check}}　SUS：{{daily_report.daily_detail.stop_metal_detector_sus_check}}</p>
                    <p>X線異物検出機動作確認</p>
                    <p>Fe：{{daily_report.daily_detail.stop_x_detector_fe_check}}　SUS：{{daily_report.daily_detail.stop_x_detector_sus_check}}　GI：{{daily_report.daily_detail.stop_x_detector_gi_check}}　PVC：{{daily_report.daily_detail.stop_x_detector_pvc_check}}</p>
                    <p>state：　{{daily_report.daily_detail.state}}　is_finished：{{daily_report.daily_detail.is_finished}}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
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
                }
            },
        }
    },
    mounted () {
        this.getDailyReport()
    },
    watch: {
        //
    },
    computed: {

    },
    methods: {
        async getDailyReport() {
            axios.get('/api/daily_report/'+this.daily_report_id, this.daily_report_id)
            .then(response => {
                this.daily_report = response.data;
            })
            .catch(error => {
                console.log(error);
            });
        },
        onBack() {
            this.$router.push({ name: 'daily_report' })
        },
        onUpdate(status) {
            if (status == 'state') {
                if (!confirm('このデータを一時保存しますか？')) {
                    return
                }
            this.daily_report.daily_detail.state = '実行中'
            this.message = 'データを一時保存しました'
            } else if (status == 'finished') {
                if (!confirm('このデータを登録しますか？')) {
                    return
                }
            this.daily_report.daily_detail.state = '完了'
            this.daily_report.daily_detail.is_finished = true
            this.message = 'データを登録しました'
            }
            axios.post('/api/daily_report/'+this.daily_report_id, { daily_report: this.daily_report, _method: 'put'})
            .then(alert(this.message),this.$router.push({ name: 'daily_report' }))
            .catch(function (error) {
                console.log(error);
            });
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
        onStart() { 
            let moment = require("moment");
            return this.daily_report.daily_detail.started_on = moment().format("HH:mm")
        },
        onFinish() { 
            let moment = require("moment");
            return this.daily_report.daily_detail.finished_on = moment().format("HH:mm")
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