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
                                <button type="button" class="btn btn-success">ダウンロード</button>
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
                                    <option>3</option>
                                    <option>4</option>
                                </select>
                            </div>
                            <div class="col-2 align-self-center">号機</div>
                            <div class="col-2 align-self-center ml-3">作業日</div>
                            <input type="text" v-model="dailies.worked_on" class="col-3 align-self-center" readonly>
                        </div>
                        <div class="row">
                            <div class="col-12 mt-3"></div>
                            <div class="col-2 align-self-center">品番</div>
                            <input type="text" v-model="items.code" class="col-3 align-self-center">
                            <div class="col-2 align-self-center ml-3">担当者</div>
                            <input type="text" v-model="employees.last_name" class="col-3 align-self-center" readonly>
                        </div>

<div class="collapse" id="example-1">
                        <div class="row">
                            <div class="col-12 mt-3"></div>
                            <div class="form-check align-self-center">
                                <input class="form-check-input" type="checkbox" id="check1a" v-model="daily_details.is_oxygen_scavenger">
                                <label class="form-check-label" for="check1a">脱酸素剤</label>
                            </div>
                            <div class="form-check ml-3 align-self-center">
                                <input class="form-check-input" type="checkbox" id="check1b" v-model="daily_details.is_packaging_material">
                                <label class="form-check-label" for="check1b">包装材料</label>
                            </div>
                            <div class="form-check ml-3 align-self-center">
                                <input class="form-check-input" type="checkbox" id="check1c" v-model="daily_details.is_filling_gas">
                                <label class="form-check-label" for="check1c">充填ガス</label>
                            </div>
                            <div class="align-self-center mx-3">作業員数</div>
                            <input type="number" v-model.number="daily_details.workers_number" class="col-2 align-self-center">
                        </div>

                        <div class="row">
                            <div class="col-12 mt-3"></div>
                            <div class="col-12"><strong>金属検出機動作確認</strong></div>
                            <div class="form-check align-self-center">
                                <input class="form-check-input" type="checkbox" id="check1a" v-model="daily_details.start_metal_detector_fe_check">
                                <label class="form-check-label" for="check1a">Fe</label>
                            </div>
                            <div class="form-check ml-3 align-self-center">
                                <input class="form-check-input" type="checkbox" id="check1b" v-model="daily_details.start_metal_detector_sus_check">
                                <label class="form-check-label" for="check1b">SUS</label>
                            </div>
                        </div>

                         <div class="row">
                            <div class="col-12 mt-3"></div>
                            <div class="col-12"><strong>X線異物検出機動作確認</strong></div>
                            <div class="form-check align-self-center">
                                <input class="form-check-input" type="checkbox" id="check1a" v-model="daily_details.start_x_detector_fe_check">
                                <label class="form-check-label" for="check1a">Fe</label>
                            </div>
                            <div class="form-check ml-3 align-self-center">
                                <input class="form-check-input" type="checkbox" id="check1b" v-model="daily_details.start_x_detector_sus_check">
                                <label class="form-check-label" for="check1b">SUS</label>
                            </div>
                            <div class="form-check ml-3 align-self-center">
                                <input class="form-check-input" type="checkbox" id="check1a" v-model="daily_details.start_x_detector_gi_check">
                                <label class="form-check-label" for="check1a">GI</label>
                            </div>
                            <div class="form-check ml-3 align-self-center">
                                <input class="form-check-input" type="checkbox" id="check1b" v-model="daily_details.start_x_detector_pvc_check">
                                <label class="form-check-label" for="check1b">PVC</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 mt-3"></div>
                            <button type="button" class="btn btn-success btn-lg col-8 ml-3">作業開始</button>
                            <div class="ml-3 align-self-center">{{ daily_details.started_on }}</div>
                        </div>

                        <div class="row">
                            <div class="col-12 mt-3"></div>
                            <div class="align-self-center mx-3">良品数</div>
                            <input type="number" v-model.number="daily_details.pass_amount" class="col-2 align-self-center">
                            <div class="align-self-center mx-3">リパック数</div>
                            <input type="number" v-model.number="daily_details.repack_amount" class="col-2 align-self-center">
                        </div>

                        <div class="row">
                            <div class="col-12 mt-3"></div>
                            <div class="col-12"><strong>不良品数</strong></div>
                            <div class="align-self-center mx-3">軽量</div>
                            <input type="number" v-model.number="daily_details.lightweight" class="col-1 align-self-center">
                            <div class="align-self-center mx-3">外観等</div>
                            <input type="number" v-model.number="daily_details.appearance" class="col-1 align-self-center">
                            <div class="align-self-center mx-3">金属排除</div>
                            <input type="number" v-model.number="daily_details.metal_removal" class="col-1 align-self-center">
                            <div class="align-self-center mx-3">X線排除</div>
                            <input type="number" v-model.number="daily_details.x_removal" class="col-1 align-self-center">
                        </div>

                        <div class="row">
                            <div class="col-12 mt-3"></div>
                            <button type="button" class="btn btn-danger btn-lg col-8 ml-3">作業終了</button>
                            <div class="ml-3 align-self-center">{{ daily_details.finished_on }}</div>
                        </div>

                        <div class="row">
                            <div class="col-12 mt-3"></div>
                            <div class="col-12"><strong>金属検出機動作確認</strong></div>
                            <div class="form-check align-self-center">
                                <input class="form-check-input" type="checkbox" id="check1a" v-model="daily_details.stop_metal_detector_fe_check">
                                <label class="form-check-label" for="check1a">Fe</label>
                            </div>
                            <div class="form-check ml-3 align-self-center">
                                <input class="form-check-input" type="checkbox" id="check1b" v-model="daily_details.stop_metal_detector_sus_check">
                                <label class="form-check-label" for="check1b">SUS</label>
                            </div>
                        </div>

                         <div class="row">
                            <div class="col-12 mt-3"></div>
                            <div class="col-12"><strong>X線異物検出機動作確認</strong></div>
                            <div class="form-check align-self-center">
                                <input class="form-check-input" type="checkbox" id="check1a" v-model="daily_details.stop_x_detector_fe_check">
                                <label class="form-check-label" for="check1a">Fe</label>
                            </div>
                            <div class="form-check ml-3 align-self-center">
                                <input class="form-check-input" type="checkbox" id="check1b" v-model="daily_details.stop_x_detector_sus_check">
                                <label class="form-check-label" for="check1b">SUS</label>
                            </div>
                            <div class="form-check ml-3 align-self-center">
                                <input class="form-check-input" type="checkbox" id="check1a" v-model="daily_details.stop_x_detector_gi_check">
                                <label class="form-check-label" for="check1a">GI</label>
                            </div>
                            <div class="form-check ml-3 align-self-center">
                                <input class="form-check-input" type="checkbox" id="check1b" v-model="daily_details.sstop_x_detector_pvc_check">
                                <label class="form-check-label" for="check1b">PVC</label>
                            </div>
                        </div>
</div>

                        <div class="row">
                            <div class="col-12 mt-3"></div>
                            <div class="align-self-center">
                                <button type="button" class="btn btn-primary btn-sm"
                                    data-toggle="collapse"
                                    data-target="#example-1"
                                    aria-expand="false"
                                    aria-controls="example-1">＋</button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 mt-3"></div>
                            <div class="align-self-center">
                                <button type="button" class="btn btn-outline-danger">この日報を削除する</button>
                            </div>
                            <div class="align-self-center ml-5">
                                <button type="button" class="btn btn-primary">登録する</button>
                            </div>
                            <div class="align-self-center ml-5">
                                <button type="button" class="btn btn-success">一時保存</button>
                            </div>
                        </div>

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
                                <p>ライン名：{{dailies.line_name}}　　作業日：{{dailies.worked_on}}</p>
                                <p>品番：{{items.code}}　　担当者：{{employees.last_name}}</p>
                                <p>脱酸素剤：{{daily_details.is_oxygen_scavenger}}　包装材料：{{daily_details.is_packaging_material}}　充填ガス：{{daily_details.is_filling_gas}}　作業員数：{{daily_details.workers_number}}</p>
                                <p><strong>金属検出機動作確認</strong></p>
                                <p>Fe：{{daily_details.start_metal_detector_fe_check}}　SUS：{{daily_details.start_metal_detector_sus_check}}</p>
                                <p><strong>X線異物検出機動作確認</strong></p>
                                <p>Fe：{{daily_details.start_x_detector_fe_check}}　SUS：{{daily_details.start_x_detector_sus_check}}　GI：{{daily_details.start_x_detector_gi_check}}　PVC：{{daily_details.start_x_detector_pvc_check}}</p>
                                <p>作業開始：{{daily_details.started_on}}　作業終了：{{daily_details.finished_on}}</p>
                                <p>良品数：{{daily_details.pass_amount}}　リパック数：{{daily_details.repack_amount}}</p>
                                <p><strong>不良品数</strong></p>
                                <p>軽量：{{daily_details.lightweight}}　外観等：{{daily_details.appearance}}　金属排除：{{daily_details.metal_removal}}　X線排除：{{daily_details.x_removal}}</p>
                                <p><strong>金属検出機動作確認</strong></p>
                                <p>Fe：{{daily_details.stop_metal_detector_fe_check}}　SUS：{{daily_details.stop_metal_detector_sus_check}}</p>
                                <p><strong>X線異物検出機動作確認</strong></p>
                                <p>Fe：{{daily_details.stop_x_detector_fe_check}}　SUS：{{daily_details.stop_x_detector_sus_check}}　GI：{{daily_details.stop_x_detector_gi_check}}　PVC：{{daily_details.stop_x_detector_pvc_check}}</p>
                                <p>state：　{{daily_details.state}}　is_finished：{{daily_details.is_finished}}</p>
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
            items: {
                id: null,
                code: '',
                name: '',
            },
            employees: {
                user_id: null,
                last_name: '川畑',
            },
            daily_details: {
                item_id: 0,
                employee_id: 0,
                is_oxygen_scavenger: false,
                is_packaging_material: false,
                is_filling_gas: false,
                workers_number: null,
                start_metal_detector_fe_check: false,
                start_metal_detector_sus_check: false,
                start_x_detector_fe_check: false,
                start_x_detector_sus_check: false,
                start_x_detector_gi_check: false,
                start_x_detector_pvc_check: false,
                started_on: '00:00',
                finished_on: '12:00',
                pass_amount: null,
                repack_amount: null,
                lightweight: null,
                appearance: null,
                metal_removal: null,
                x_removal: null,
                stop_metal_detector_fe_check: false,
                stop_metal_detector_sus_check: false,
                stop_x_detector_fe_check: false,
                stop_x_detector_sus_check: false,
                stop_x_detector_gi_check: false,
                stop_x_detector_pvc_check: false,
                state: '',
                is_finished: false,
            }
        }
    },
    mounted () {
        this.getDaily()
        this.getItem()
        this.getEmployee()
        this.setToday()
        this.grtDaily_detail()
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
            return this.dailies
        },
        getItem() {
            return this.items
        },
        getEmployee() {
            return this.employees
        },
        setToday() {
            let today = new Date();
            let year = today.getFullYear();
            let month = today.getMonth()+1;
            let week = today.getDay();
            let day = today.getDate();
            return this.dailies.worked_on = year + '/' + month + '/' + day;
        },
        getDaily_detail() {
            return this.daily_details
        }
    },
}
</script>

<style lang="scss" scoped>
@import "resources/sass/variables";
</style>