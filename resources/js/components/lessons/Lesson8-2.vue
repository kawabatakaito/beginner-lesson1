<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-start mb-3">
                        <div class="mr-auto">
                            <span class="span-header">Lesson 8-2</span>
                        </div>
                        <div class="align-self-center">
                            <button type="button" class="btn btn-dark" @click="onBack">戻る</button>
                        </div>
                    </div>
                    
                    <div class="quesion-header">ルーティング</div>
                    <div class="mb-3">
                        <h3>Lesson8から引数付きで画面遷移</h3>
                    </div>
                    <div class="d-flex justify-content-start mb-3">
                        <div class="mr-4">
                            <button type="button" class="btn btn-primary" @click="onNext">Leeson8へ</button>
                        </div>
                    </div>
                    <p>propsから渡された引数</p>
                    <h4>{{ propsData() }}</h4>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: {
        textData: String
    },
    data () {
        return {
            text: ''
        }
    },
    mounted () {
        //
    },
    watch: {
        //
    },
    computed: {
        //
    },
    methods: {
        onNext() {
            this.$router.push({ name: 'lesson8' })
        },
        onBack() {
            this.$router.push({ name: 'home' })
        },
        propsData() {
            if (!this.textData) {
                return this.textData = 'データなし'
            } else {
                return this.textData
            }
        }
    },
}
</script>

<style lang="scss" scoped>
@import "resources/sass/variables";
</style>