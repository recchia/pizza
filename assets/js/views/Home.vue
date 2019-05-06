<template>
    <div>
        <div class="row columns is-multiline">
            <div v-if="isLoading" class="row col">
                <p>Loading...</p>
            </div>

            <div v-else-if="hasError" class="notification is-danger">
                  {{ error }}
            </div>

            <div v-else-if="!hasPosts" class="notification is-warning">
                No posts!
            </div>

            <div v-else v-for="pizza in pizzas">
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
            };
        },
        created() {
            this.$store.dispatch('pizza/fetchPizzas');
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
            hasPosts () {
                return this.$store.getters['pizza/hasPizzas'];
            },
            pizzas () {
                return this.$store.getters['pizza/pizzas'];
            },
        },
    }
</script>