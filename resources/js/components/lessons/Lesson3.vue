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
                    <p><input type="text" v-model="display"></p>
                    <p>
                        <button style="width:2rem;" @click="display += '7'">7</button>
                        <button style="width:2rem;" @click="display += '8'">8</button>
                        <button style="width:2rem;" @click="display += '9'">9</button>
                        <button style="width:2rem;" @click="dividedPush">/</button>
                        <button style="width:2rem;" @click="clearPush">C</button>
                    </p>
                    <p>
                        <button style="width:2rem;" @click="display += '4'">4</button>
                        <button style="width:2rem;" @click="display += '5'">5</button>
                        <button style="width:2rem;" @click="display += '6'">6</button>
                        <button style="width:2rem;" @click="multipliedPush">*</button>
                    </p>
                    <p>
                        <button style="width:2rem;" @click="display += '1'">1</button>
                        <button style="width:2rem;" @click="display += '2'">2</button>
                        <button style="width:2rem;" @click="display += '3'">3</button>
                        <button style="width:2rem;" @click="minusPush">-</button>
                    </p>
                    <p>
                        <button style="width:2rem;" @click="display += '0'">0</button>
                        <button style="width:2rem;" @click="display += '.'">.</button>
                        <button style="width:2rem;" @click="plusPush">+</button>
                        <button style="width:2rem;" @click="equalPush">=</button>
                    </p>
                    <p>計算式　<input type="text" v-model="memoly"></p>
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
            display: '',
            memoly: '',
        }
    },
    mounted () {
        //
    },
    watch: {
        //
    },
    computed: {
        memoly() {
            return this.memoly
        },
        display() {
            return this.display
        }
    },
    methods: {
        onBack() {
            this.$router.push({ name: 'home' })
        },
        plusPush() {
           this.memoly += this.display + '+'
           return this.display = ''
        },
        minusPush() {
           this.memoly += this.display + '-'
           return this.display = ''
        },
        multipliedPush() {
           this.memoly += this.display + '*'
           return this.display = ''
        },
        dividedPush() {
           this.memoly += this.display + '/'
           return this.display = ''
        },
        equalPush() {
           this.memoly  += this.display
           this.display = Function('return ('+this.memoly+');')();
           return this.memoly  = ''
        },
        clearPush() {
           this.memoly  = ''
           return this.display = ''
        }
    },
}
</script>

<style lang="scss" scoped>
@import "resources/sass/variables";
</style>