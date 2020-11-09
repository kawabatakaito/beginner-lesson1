<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-start mb-3">
                        <div class="mr-auto">
                            <span class="span-header">Lesson 6</span>
                        </div>
                        <div class="align-self-center">
                            <button type="button" class="btn btn-dark" @click="onBack">戻る</button>
                        </div>
                    </div>
                    
                    <div class="quesion-header">APIを使って取得したデータを表示しましょう</div>
                    <div class="d-flex flex-wrap justify-content-start mt-1 mb-2">
                        <div class="d-flex mr-3">
                            <div class="align-self-center">version：</div>
                            <div class="align-self-center">
                                <input class="form-control" v-model="items.info.version">
                            </div>
                        </div>
                    </div>
                    <div v-for="result in items.results" :key="result.index">
                        <p>Name：
                            <input type="text" v-model="result.name.first">
                            <input type="text" v-model="result.name.last">
                        </p>
                        <p>Country：
                            <input type="text" v-model="result.location.country">
                        </p>
                        <p>Email：
                            <input type="text" v-model="result.email">
                        </p>
                    </div>
                    <h2>Covid　都道府県別累計感染者数</h2>

                    <div v-for="data in datas" :key="data.index">
                        <p>更新日：
                            <input type="text" v-model="data.lastUpdate">
                        </p>
                        <div v-for="area in data.area" :key="area.index">
                            <p>都道府県：
                                <input type="text" v-model="area.name_jp">
                                累計感染者数：<input type="text" v-model="area.npatients">
                            </p>
                        </div>
                    </div>
                    <hr>
                    <div class="alert alert-warning" role="alert">
                        <i class="fas fa-book-reader"></i> 応用編：公開されているAPIを使ってデータを取得してましょう。「http://smsurf.app-rox.com/api/」
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
    data () {
        return {
            items: null,
            datas: null,
        }
    },
    mounted () {
        this.getInit();
        this.getData();
    },
    watch: {
        //
    },
    computed: {
        //
    },
    methods: {
        async getInit() {
            // WebAPIとは
            // https://qiita.com/NagaokaKenichi/items/df4c8455ab527aeacf02
            // API呼出しの基本形
            const {data} = await axios.get('https://randomuser.me/api/')
            // 取得したデータはchromeのデバッグツールで確認できます。
            // https://qiita.com/nonkapibara/items/8b587013b6b817d6dfc4
            this.items = data
        },
        async getData() {
            // const {covid} = await axios.get('https://data.corona.go.jp/converted-json/covid19japan-all.json')
            // this.datas = covid
            axios.get('https://data.corona.go.jp/converted-json/covid19japan-all.json')
            .then(response => {
                this.datas= response.data;
            })
            .catch(error => {
                console.log(error);
            });
        },
        onBack() {
            this.$router.push({ name: 'home' })
        }
    },
}
</script>

<style lang="scss" scoped>
@import "resources/sass/variables";
</style>