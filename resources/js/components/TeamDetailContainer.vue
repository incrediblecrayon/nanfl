<template>
    <div>
        <div class="team-title-container">
            <team-title :team-data="teamData"> <!-- TODO - Remove useless data.-->
                <!--<template slot="links">-->
                    <!--<a href="/team/edit"><i class="far fa-edit"></i>&nbsp&nbspEdit Team</a>-->
                <!--</template>-->
            </team-title>
        </div>

        <div class="player-list-container">
            <list-table :list-data="teamData.players">
                <template slot="list-title">
                    <h1>Player List</h1>
                </template>
            </list-table>
        </div>
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
                teamData:{
                    players:[]
                },
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