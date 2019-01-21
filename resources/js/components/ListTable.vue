<template>
    <div class="list-table-wrapper">
        <slot name="list-title">
            <h1>List Title</h1>
        </slot>

        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col" class="d-none d-lg-block">Edit</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="player in listData">
                <th scope="row">
                    <span class="d-none d-lg-block">{{player.id}}</span>
                    <span class="d-lg-none">
                        <a :href="`/player/${player.id}/edit`">{{player.id}}</a>
                    </span>
                </th>
                <td>{{player.first_name}}</td>
                <td>{{player.last_name}}</td>
                <td class="d-none d-lg-block">
                    <a :href="`/player/${player.id}/edit`">Edit Player</a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default{
        props:{
            listData:{
                required:true,
                type:Array
            }
        }
    }
</script>