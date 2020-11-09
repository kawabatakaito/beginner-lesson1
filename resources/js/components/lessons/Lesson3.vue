<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-start mb-3">
                        <div class="mr-auto">
                            <span class="span-header">Lesson 3</span>
                        </div>
                        <div class="align-self-center">
                            <button type="button" class="btn btn-dark" @click="onBack">戻る</button>
                        </div>
                    </div>
                    
                    <div class="quesion-header">電卓を作成してください。</div>
                    <p>
                        <button style="width:2rem;" v-on:click="count += '7'">7</button>
                        <button style="width:2rem;" v-on:click="count += '8'">8</button>
                        <button style="width:2rem;" v-on:click="count += '9'">9</button>
                    </p>
                    <p>
                        <button style="width:2rem;" v-on:click="count += '4'">4</button>
                        <button style="width:2rem;" v-on:click="count += '5'">5</button>
                        <button style="width:2rem;" v-on:click="count += '6'">6</button>
                    </p>
                    <p>
                        <button style="width:2rem;" v-on:click="count += '1'">1</button>
                        <button style="width:2rem;" v-on:click="count += '2'">2</button>
                        <button style="width:2rem;" v-on:click="count += '3'">3</button>
                    </p>
                    <p><button style="width:2rem;" v-on:click="count += '0'">0</button></p>
                        <input type="number" v-model.number="count">

                    <p>
                        <button style="width:2rem;" v-on:click="count2 += '7'">7</button>
                        <button style="width:2rem;" v-on:click="count2 += '8'">8</button>
                        <button style="width:2rem;" v-on:click="count2 += '9'">9</button>
                    </p>
                    <p>
                        <button style="width:2rem;" v-on:click="count2 += '4'">4</button>
                        <button style="width:2rem;" v-on:click="count2 += '5'">5</button>
                        <button style="width:2rem;" v-on:click="count2 += '6'">6</button>
                    </p>
                    <p>
                        <button style="width:2rem;" v-on:click="count2 += '1'">1</button>
                        <button style="width:2rem;" v-on:click="count2 += '2'">2</button>
                        <button style="width:2rem;" v-on:click="count2 += '3'">3</button>
                    </p>
                    <p><button style="width:2rem;" v-on:click="count2 += '0'">0</button></p>
                        <input type="number" v-model.number="count2">
                    <p>
                        <button style="width:2rem;" v-on:click="col = '+' ">+</button>
                        <button style="width:2rem;" v-on:click="col = '-' ">-</button>
                        <button style="width:2rem;" v-on:click="col = '*' ">*</button>
                        <button style="width:2rem;" v-on:click="col = '/' ">/</button>
                    </p>
                    
                        <p>{{ result }}</p>
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
            count: '',
            count2: '',
            col: '',
        }
    },
    mounted () {
        //
    },
    watch: {
        //
    },
    computed: {
        result() {
            if (this.col == '+') {
                return Number(this.count) + Number(this.count2)
            } else if (this.col == '-' ){
                return Number(this.count) - Number(this.count2)
            } else if (this.col == '*' ){
                return Number(this.count) * Number(this.count2)
            } else if (this.col == '/' ){
                return Number(this.count) / Number(this.count2)
            }
        }
    },
    methods: {
        onBack() {
            this.$router.push({ name: 'home' })
        }
    },
}
</script>

<style lang="scss" scoped>
@import "resources/sass/variables";
</style>