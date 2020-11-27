<template>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-start mb-3">
                    <div class="mr-auto">
                        <span class="span-header font-bold">包装ライン日報</span>
                    </div>
                    <div class="align-self-center">
                        <button type="button" class="btn btn-dark" @click="onBack">戻る</button>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="align-self-center font-bold ml-3">ライン</div>
                    <div class="align-self-center">
                        <select id="line_name" class="form-control" v-model="daily_report.line_name">
                            <option></option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
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
                            <div class="row align-self-center">
                                <div class="col-12 mt-2"></div>
                                <div class="ml-3 mr-1 font-bold align-self-center">品番
                                    <input type="text" v-model="daily_detail.item_code" class="align-self-center" data-toggle="modal" :data-target="'#search-item'+index" readonly>
                                    <button type="button" class="btn btn-primary mr-2" data-toggle="modal" :data-target="'#search-item'+index">検索</button>商品名：{{daily_detail.item_name}}
                                </div>
                                <!-- ここからモーダル部分 -->
                                <div class="modal fade" :id="'search-item'+index" tabindex="-1" role="dialog" aria-labelledby="search-item-label" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="search-item-label">商品検索</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-center">
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
                                                        <tr class="clickable" v-for="item in items" :key="item.index" :value="item.id" @click="getItemId(daily_detail,item)">
                                                            <td class="text-center align-middle" >{{ item.code }}</td>
                                                            <td class="text-center align-middle">{{ item.name }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                    <div class="text-center align-middle">
                                                        <strong>選択　コード：　</strong>{{daily_detail.item_code}}
                                                        <strong>　商品名：　</strong>{{daily_detail.item_name}}
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- ここまでモーダル -->
                            </div>

                            <p><strong>item_id: </strong>{{daily_detail.item_id}}</p>
                            
                            <div class="row align-self-center mt-2">
                                <div class="ml-3 mr-1 font-bold" v-cloak>担当者
                                    {{loginUserId}}：{{loginUserName}}
                                </div>
                                <input type="hidden" v-model="daily_detail.employee_id">
                            </div>
                    
                            <div class="row mt-3">
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
                            </div>

                            <div class="row mt-3">
                                <div class="align-self-center mx-3 font-bold">作業員数</div>
                                <input type="text" v-model="daily_detail.workers_number" class="align-self-center" data-toggle="modal" :data-target="'#tenkey'+index" @click="setChangeColumn('workers_number')" readonly>
                            </div>

                            <div class="row mt-3">
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

                            <div class="row mt-3">
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

                            <div class="row mt-3">
                                <button type="button" :class="['btn col-8 ml-3 py-3', daily_detail.state === '実行前' ? 'btn-success' :'btn-outline-success']"
                                :disabled="daily_detail.state !== '実行前'" @click="onStart(daily_detail)">作業開始</button>
                                <div class="ml-3 mt-2 align-self-center time-font">{{ daily_detail.started_on }}</div>
                            </div>

                            <div class="row mt-3 font-bold">
                                <div class="col-sm-12 col-md-5 mt-3">
                                    良品数<input type="text" class="ml-2" v-model="daily_detail.pass_amount" data-toggle="modal" :data-target="'#tenkey'+index" @click="setChangeColumn('pass_amount')" readonly>
                                </div>
                                <div class="col-sm-12 col-md-5 mt-3">
                                    リパック数<input type="text" class="ml-2" v-model="daily_detail.repack_amount" data-toggle="modal" :data-target="'#tenkey'+index" @click="setChangeColumn('repack_amount')" readonly>
                                </div>
                            </div>

                            <div class="row mt-5 font-bold">
                                <div class="col-12">不良品数</div>
                                <div class="col-sm-12 col-md-6 col-lg-2 mt-1">
                                    軽量<input type="text" v-model="daily_detail.lightweight" class="ml-2" data-toggle="modal" :data-target="'#tenkey'+index" @click="setChangeColumn('lightweight')" readonly>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-2 mt-1">
                                    外観等<input type="text" v-model="daily_detail.appearance" class="ml-2" data-toggle="modal" :data-target="'#tenkey'+index" @click="setChangeColumn('appearance')" readonly>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-2 mt-1">
                                    金属排除<input type="text" v-model="daily_detail.metal_removal" class="ml-2" data-toggle="modal" :data-target="'#tenkey'+index" @click="setChangeColumn('metal_removal')" readonly>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-2 mt-1">
                                    X線排除<input type="text" v-model="daily_detail.x_removal" class="ml-2" data-toggle="modal" :data-target="'#tenkey'+index" @click="setChangeColumn('x_removal')" readonly>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <button type="button" :class="['btn col-8 ml-3 py-3', daily_detail.state === '実行中' ? 'btn-danger' : 'btn-outline-danger']"
                                :disabled="daily_detail.state !== '実行中'" @click="onFinish(daily_detail)">作業終了</button>
                                <div class="ml-3 align-self-center time-font">{{ daily_detail.finished_on }}</div>
                            </div>

                            <div class="row mt-3">
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

                            <div class="row mt-3">
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

                            <div class="row mt-3">
                                <div class="align-self-center ml-3">
                                    <button type="button" class="btn btn-primary btn-sm" @click="onPlus(index)">＋</button>
                                </div>
                                <div class="align-self-center ml-3">
                                    <button type="button" class="btn btn-sm btn-outline-danger" v-if="index>=1" @click="onMinus(index)">－</button>
                                </div>
                            </div>

                            <!-- ここからテンキーのモーダル部分 -->
                            <div class="modal fade" :id="'tenkey'+index" tabindex="-1" role="dialog" aria-labelledby="tenkey-label" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="tenkey-label">入力</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <input type="text" v-model="number" class="mb-3" readonly>
                                            <div class="col-12">
                                                <button class="px-3 py-2" @click="number += 1 ">1</button>
                                                <button class="px-3 py-2" @click="number += 2 ">2</button>
                                                <button class="px-3 py-2" @click="number += 3 ">3</button>
                                            </div>
                                            <div class="col-12 mt-1">
                                                <button class="px-3 py-2" @click="number += 4 ">4</button>
                                                <button class="px-3 py-2" @click="number += 5 ">5</button>
                                                <button class="px-3 py-2" @click="number += 6 ">6</button>
                                            </div>
                                            <div class="col-12 mt-1">
                                                <button class="px-3 py-2" @click="number += 7 ">7</button>
                                                <button class="px-3 py-2" @click="number += 8 ">8</button>
                                                <button class="px-3 py-2" @click="number += 9 ">9</button>
                                            </div>
                                            <div class="col-12 mt-1">
                                                <button class="px-3 py-2" @click="number += '.' "> .</button>
                                                <button class="px-3 py-2" @click="number += 0 ">0</button>
                                                <button class="px-3 py-2" @click="number = '' ">C</button>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-dismiss="modal" @click="setNumber(number, daily_detail)">OK</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ここまでモーダル -->
                        </div>
                    </div>
                </div>
                <!-- ここまでv-forで追加 -->

                <div class="row justify-content-center">
                    <button type="button" class="btn btn-primary mt-4" @click="onCreate('finished')">登録する</button>
                </div>

                <button type="button" class="btn btn-success btn-state" @click="onCreate('state')">一時保存</button>
                
            </div>
        </div>
    </div>
</template>

<script>
import moment from 'moment';
export default {
    props: {
        //
    },
    data() {
        return {
            message: '',
            login_user_name: '',
            item_id: '',
            daily_report: {
                id: '',
                line_name: '',
                worked_on: '',
                daily_details: [],
            },
            search_item_code: '',
            search_item_name: '',
            items: [],
            default_daily_report: {
                id:'',
                line_name:'',
                worked_on:'',
                report_details:[],
            },
            default_daily_detail: {
                id: '',
                daily_report_id: '',
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
                started_on: '',
                finished_on: '',
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
                item_name: '',
                item_code: '',
            },
            user_name: '',
            number: '',
            change_column: '',
        }
    },
    mounted () {
        this.getUser()
        this.addFirstDailyDetail()
        this.getDailyReports()
        this.setWorkedOn()
        this.getDailyDetail()
    },
    watch: {
        //
    },
    computed: {
        loginUserName() {
            var user = this.$store.state.user
            if (!user.employee) {
                return user.name
            }
            return user.employee.last_name + ' ' + user.employee.first_name
        },
        loginUserId() {
            var user = this.$store.state.user
            if (!user.employee) {
                return 'IDなし'
            }
            return user.employee_id
        },
    },
    methods: {
        getUser() {
            this.default_daily_detail.employee_id = this.$store.state.user.employee_id
        },
        addFirstDailyDetail() {
            this.daily_report.daily_details.push(_.cloneDeep(this.default_daily_detail))
        },
        onBack() {
            this.$router.push({ name: 'daily_report' })
        },
        getDailyReports() {
            this.daily_report
        },
        setWorkedOn() {
            this.daily_report.worked_on = moment().format("YYYY-MM-DD")
        },
        getDailyDetail() {
            this.daily_details
        },
        onStart(daily_detail) { 
            daily_detail.state = '実行中'
            daily_detail.started_on = moment().format("HH:mm")
        },
        onFinish(daily_detail) { 
            daily_detail.state = '完了'
            return daily_detail.finished_on = moment().format("HH:mm")
        },
        onCreate(status) {
            var line_name_exist = true
            var item_name_exist = true
            if (status == 'state') {
                if (!confirm('このデータを一時保存しますか？')) {
                    return
                }
                this.message = 'データを一時保存しました'
            } else if (status == 'finished') {
                if (!confirm('このデータを登録しますか？')) {
                    return
                }
                this.message = 'データを登録しました'
            }
            if (!this.daily_report.line_name) {
                line_name_exist = false
            }
            this.daily_report.daily_details.forEach(daily_detail => {
                daily_detail.employee_id = this.$store.state.user.employee_id
                this.$delete(daily_detail, 'item_name')
                this.$delete(daily_detail, 'item_code')
                if (!daily_detail.item_id) {
                    item_name_exist = false
                }
            }) 
            if (line_name_exist && item_name_exist) {
                axios.post('/api/daily_report/store', {
                    daily_report: this.daily_report,
                })
                .then(alert(this.message),this.$router.push({ name: 'daily_report' }))
                .catch(error => {
                    console.log(error);
                });
            } else if (!line_name_exist && !item_name_exist) {
                alert('ラインと商品名を入力してください')
            } else if (line_name_exist) {
                alert('商品名を入力してください')
            } else {
                alert('ラインを入力してください')
            }
        },
        onPlus(index) {
            this.daily_report.daily_details.splice(index + 1, 0, _.cloneDeep(this.default_daily_detail))
        },
        onMinus(index) {
            this.daily_report.daily_details.splice(index, 1)
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
        getItemId(daily_detail, item) {
            daily_detail.item_id = item.id
            daily_detail.item_name = item.name
            daily_detail.item_code = item.code
            this.items = []
        },
        setNumber(number, daily_detail) {
            if (this.change_column == 'workers_number') {
                daily_detail.workers_number = number
            } else if (this.change_column == 'pass_amount') {
                daily_detail.pass_amount = number
            } else if (this.change_column == 'repack_amount') {
                daily_detail.repack_amount = number
            } else if (this.change_column == 'lightweight') {
                daily_detail.lightweight = number
            } else if (this.change_column == 'appearance') {
                daily_detail.appearance = number
            } else if (this.change_column == 'metal_removal') {
                daily_detail.metal_removal = number
            } else if (this.change_column == 'x_removal') {
                daily_detail.x_removal = number
            }
            this.change_column = ''
            this.number = ''
        },
        setChangeColumn(column){
            this.change_column = column
        },
    },
}
</script>

<style lang="scss" scoped>
@import "resources/sass/variables";
[v-cloak] {
    display: none;
}

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

