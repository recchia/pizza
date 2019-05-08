<template>
    <div class="container">
        <div class="section">
            <div class="box">
                <div class="field has-addons">
                    <div class="control is-expanded">
                        <input class="input has-text-centered" type="search" :v-model="keyword" placeholder="» » » » » » find me « « « « « «">
                    </div>
                    <div class="control">
                        <a class="button is-info" @click="this">Search</a>
                    </div>
                </div>
            </div>
        </div>
        <router-view></router-view>
    </div>
</template>

<script>
    export default {
        name: "App"
    }
</script>