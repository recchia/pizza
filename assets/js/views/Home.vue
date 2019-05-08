<template>
    <div>
        <div class="row columns is-multiline">
            <div v-if="isLoading" class="row col">
                <p>Loading...</p>
            </div>

            <div v-else-if="hasError" class="notification is-danger">
                  {{ error }}
            </div>

            <div v-else-if="!hasPizzas" class="notification is-warning">
                No posts!
            </div>

            <div v-else v-for="pizza in filterByKeyword">
                <Pizza :pizza="pizza"></Pizza>
            </div>
        </div>
    </div>
</template>

<script>
    import Pizza from '../components/Pizza';

    export default {
        name: "Home",
        components: {
            Pizza
        },
        data () {
            return {
                pizza: {},
                keyword: '',
            };
        },
        created() {
            this.$store.dispatch('pizza/fetchPizzas');
            this.$store.dispatch('pizza/filterByKeyword');
        },
        computed: {
            isLoading () {
                return this.$store.getters['pizza/isLoading'];
            },
            hasError () {
                return this.$store.getters['pizza/hasError'];
            },
            error () {
                return this.$store.getters['pizza/error'];
            },
            hasPizzas () {
                return this.$store.getters['pizza/hasPizzas'];
            },
            pizzas () {
                return this.$store.getters['pizza/pizzas'];
            },
            filterByKeyword () {
                return this.$store.getters['pizza/filterByKeyword']
            }
        },
    }
</script>