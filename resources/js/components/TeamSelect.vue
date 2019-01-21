<template>
    <div class="dropdown team-select-menu">
        <button class="btn btn-secondary dropdown-toggle btn-block"
                type="button"
                id="dropdownMenuButton"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false">
            Select Team
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" v-for="team in teams" :href="`/team/${team.id}`">{{team.title}}</a>
        </div>
    </div>
</template>

<script>
    export default {
        // TODO - Better Prop Handling.
        // TODO - Callout for Teams if needed.
        props:["teamsData","teamsEndpoint"],
        data(){
            return {
                teams:{}
            }
        },
        created(){
            this.teams = this.teamsData;
        },
        mounted() {
            //Check if we need to grab team data.
            console.log('Component mounted.')
        },
        methods: {
            test(teamID){
                console.log(teamID)
            }
        }
    }
</script>