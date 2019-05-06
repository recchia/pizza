<template>
    <div>
        <div class="column is-one-third">
            <div class="card large round">
                <div class="card-image ">
                    <figure class="image">
                        <img src="https://www.rosarioplus.com/__export/1470861789427/sites/rosarioplus/img/2016/08/10/piza_queso.jpg_139889920.jpg" alt="Image">
                    </figure>
                </div>
                <div class="card-content">
                    <div class="media">
                        <div class="media-content">
                            <p class="title is-4 no-padding">{{ pizza.name }}</p>
                            <p><span class="title is-6">Price: {{ pizza.price }} EUR</span></p>
                        </div>
                    </div>
                    <div class="content">
                        <p class="subtitle is-6">Ingredients:</p>
                        <ul>
                            <li v-for="ingredient in pizza.ingredients">
                                {{ ingredient.name }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Pizza",
        props: ['pizza']
    }
</script>
