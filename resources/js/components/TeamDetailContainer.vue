<template>
    <div>
        <!--Dumb Component for title-->
        <!--Dumb Component for player listing.-->
    </div>
</template>

<script>
    export default {
        props:{
            team_id:{
                type: Number,
                required:true,
            }
        },
        data(){
            return {
                teamData:{},
                loading: false
            }
        },
        mounted(){
            this.getTeamDetail(this.team_id)
        },
        methods:{
            getTeamDetail(teamID){
                this.loading = true;

                axios.get('/api/team/' + teamID).then((response) => {
                    this.teamData = response.data;
                    this.loading = false;
                }).catch((response) => {
                    this.loading = false;
                    console.log('Could not fetch team detail.')
                    //TODO - Better alerting.
                });
            }
        }
    }
</script>