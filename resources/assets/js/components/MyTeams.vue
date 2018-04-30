<template>
    <div class="card card-default">
        <div class="card-body">
            <h4 class="card-title">My Teams</h4>
            <div class="table-responsive">
                <table class="table table-hover">
                    <caption>Teams that you currently belong to.</caption>
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Owner</th>
                        <th>Parent Team</th>
                        <th></th>
                    </tr>
                    </thead>

                    <tbody>
                        <tr v-for="team in teams">
                            <td>{{ team.name }}</td>
                            <td>{{ team.owner.first_name }} {{ team.owner.last_name }}</td>
                            <td>
                                Parent Team
                            </td>
                            <td class="text-right">
                                Actions
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script type="text/babel">
    export default {
        props: ['teams'],
        data() {
            return {
            }
        },

        created() {
        },

        methods: {

        }
    }
</script>
