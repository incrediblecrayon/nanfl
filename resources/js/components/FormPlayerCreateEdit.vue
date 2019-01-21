<template>
    <div class="form-player-create-edit-wrapper">
        <slot name="title">
            <h1>Create Or Edit Player</h1>
        </slot>

        <div class="container-fluid h-100 bg-light text-dark">
            <hr/>
            <div class="row justify-content-center align-items-center h-100">
                <div class="col col-sm-6 col-md-6 col-lg-6 col-xl-6">

                    <form>
                        <div class="form-group">
                            <label for="form-select-team">Team</label>
                            <select class="form-control" :class="{ 'form-group--error': $v.input.teamID.$error }" id="form-select-team" v-model="input.teamID">
                                <option v-for="team in teams" :value="team.id">{{team.id}} - {{team.title}}</option>
                            </select>
                            <div class="error" v-if="!$v.input.teamID.required">Team ID is required</div>
                        </div>

                        <div class="form-group">
                            <label for="form-player-fname">Player First Name</label>
                            <input type="text" class="form-control" :class="{ 'form-group--error': $v.input.firstName.$error }" id="form-player-fname" v-model="input.firstName" autocomplete="off"/>
                            <div class="error" v-if="!$v.input.firstName.required">First Name is required</div>
                        </div>

                        <div class="form-group">
                            <label for="form-player-lname">Player Last Name</label>
                            <input type="text" class="form-control" :class="{ 'form-group--error': $v.input.lastName.$error }" id="form-player-lname" v-model="input.lastName" autocomplete="off"/>
                            <div class="error" v-if="!$v.input.lastName.required">Last Name is required</div>
                        </div>

                        <br>
                        <br>

                        <div class="form-group">
                            <label for="form-api-token" data-toggle="tooltip" data-placement="top" title="Create and edit require authorization">API Token</label>
                            <input type="text" :class="{ 'form-group--error': $v.apiToken.$error }" class="form-control" id="form-api-token" v-model="apiToken" autocomplete="off"/>
                            <div class="error" v-if="!$v.apiToken.required">API Token is required</div>
                        </div>
                    </form>


                    <div v-if="loading">
                        <button class="btn btn-primary" disabled>Submit</button>

                        <div class="spinner-border" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>

                    <div v-else>
                        <button :disabled="$v.$invalid" class="btn btn-primary" @click="processCreateOrUpdate">Submit</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { required, minLength, between } from 'vuelidate/lib/validators'

    export default{
        props:{
            teams:{
                required:true,
                type:Array
            },
            player_id:{
                type:Number
            }
        },
        data(){
            return {
                currentPlayerData:{
                },
                input:{
                    teamID:null,
                    firstName:null,
                    lastName:null
                },
                loading:false,
                apiToken:"",
            }
        },
        created(){
            if(this.player_id)
            {
                this.getCurrentPlayerData(this.player_id);
            }
        },
        methods:{
            getCurrentPlayerData(playerID){
                this.loading = true;

                axios.get('/api/player/' + playerID).then((response) => {
                    this.currentPlayerData = response.data;
                    this.loading = false;
                    this.setInputsToCurrentPlayerData();
                }).catch((response) => {
                    this.loading = false;
                    console.log('Could not fetch player data');
                    //TODO - Better alerting.
                });
            },
            processCreateOrUpdate(){
                this.loading = true;

                axios({
                    method:(this.player_id) ? 'put':'post',
                    url:(this.player_id) ? '/api/player/' + this.player_id : '/api/player',
                    data:{
                        team_id:this.input.teamID,
                        first_name:this.input.firstName,
                        last_name:this.input.lastName
                    },
                    headers:{
                        'Authorization': 'Bearer ' + this.apiToken
                    }
                }).then((response)=>{
                    this.loading = false;
                }).catch((response) => {
                    this.loading = false;
                    console.log("Issue creating or updating");
                });
            },
            setInputsToCurrentPlayerData(){
                this.input.teamID = this.currentPlayerData.team.id;
                this.input.firstName = this.currentPlayerData.first_name;
                this.input.lastName = this.currentPlayerData.last_name;
            }
        },
        validations: {
            input:{
                firstName:{
                    required
                },
                lastName:{
                    required
                },
                teamID:{
                    required
                }
            },
            apiToken:{
                required
            }
        }
    }
</script>