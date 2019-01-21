<template>
    <div class="team-title-wrapper">
        <div class="team-title-large d-none d-lg-block">
            <h1>{{teamData.city}}</h1>
            <h1>{{teamData.name}}</h1>
        </div>

        <div class="team-title-small d-lg-none">
            <h1>{{teamData.short_title}}</h1>
        </div>

        <!--NAV LINKS FROM SLOT-->
        <div class="team-title-links">
            <slot name="links">
                <!--<a href="/team/">TEAM LINK</a>-->
            </slot>
        </div>
    </div>
</template>

<script>
    export default{
        props:{
            teamData:{
                required: true,
                type: Object
            }
            // teamTitle:{
            //     type: String,
            //     required: true
            // },
            // teamCity:{
            //     type: String,
            //     required: true
            // },
            // teamName:{
            //     type: String,
            //     required: true
            // }
        }
    }
</script>