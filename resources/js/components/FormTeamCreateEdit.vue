<template>
    <div class="form-team-create-edit-wrapper">
        <slot name="title">
            <h1>Create Or Edit Team</h1>
        </slot>

        <div class="container-fluid h-100 bg-light text-dark">
            <hr/>
            <div class="row justify-content-center align-items-center h-100">
                <div class="col col-sm-6 col-md-6 col-lg-6 col-xl-6">

                    <form>
                        <div class="form-group">
                            <label for="form-team-name">Team Name</label>
                            <input type="text" class="form-control" :class="{ 'form-group--error': $v.input.name.$error }" id="form-team-name" v-model="input.name" autocomplete="off"/>
                            <div class="error" v-if="!$v.input.name.required">Team Name is required</div>
                        </div>

                        <div class="form-group">
                            <label for="form-team-city">City</label>
                            <input type="text" class="form-control" :class="{ 'form-group--error': $v.input.city.$error }" id="form-team-city" v-model="input.city" autocomplete="off"/>
                            <div class="error" v-if="!$v.input.city.required">Team City is required</div>
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
            team_id:{
                type:Number
            }
        },
        data(){
            return {
                teamData:{
                },
                input:{
                    name:null,
                    city:null,
                    colorMain:"#000000",
                    colorAccent:"#000000"
                },
                loading:false,
                apiToken:"",
            }
        },
        created(){
            if(this.team_id)
            {
                this.getTeamData(this.team_id);
            }
        },
        methods:{
            getTeamData(teamID){
                this.loading = true;

                axios.get('/api/team/' + teamID).then((response) => {
                    this.teamData = response.data;
                    this.loading = false;
                    this.setInputsToCurrentTeamData();
                }).catch((response) => {
                    this.loading = false;
                    console.log('Could not fetch Team data');
                    //TODO - Better alerting.
                });
            },
            processCreateOrUpdate(){
                this.loading = true;

                axios({
                    method:(this.team_id) ? 'put':'post',
                    url:(this.team_id) ? '/api/team/' + this.team_id : '/api/team',
                    data:{
                        name:this.input.name,
                        city:this.input.city,
                        color_main:this.input.colorMain,
                        color_accent:this.input.colorAccent,

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
            setInputsToCurrentTeamData(){
                this.input.name = this.teamData.name;
                this.input.city = this.teamData.city;
                this.input.colorMain = this.teamData.color_main;
                this.input.colorAccent = this.teamData.color_accent;
            }
        },
        validations: {
            input:{
                city:{
                    required
                },
                name:{
                    required
                }
            },
            apiToken:{
                required
            }
        }
    }
</script>