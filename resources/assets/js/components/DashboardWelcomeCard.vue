<template>
    <div class="card card-default">
        <div class="card-body">
            <h4 class="card-title">Dashboard</h4>

            Welcome back {{ user.first_name}}. Your last login was on
            {{ lastLogin() }}
        </div>
    </div>
</template>

<script>
    import moment from "moment";
    import tz from "moment-timezone";

    export default {
        props: ['user'],

        methods: {
            lastLogin() {
                return moment(this.user.last_login);
            }
        },
    }
</script>
