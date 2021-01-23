<script>
    export default {
        template: `
        <div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card card-margin">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <span class="span-list-all">List - All</span>
                                    </div>
                                    <div class="col-md-6">
                                        <button v-on:click="calculateDist" type="button" class="btn btn-success button-list-all">Calculate Distance</button>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body table-all-list">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">ID</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Latitude</th>
                                            <th scope="col">Longitude</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, index) in orderedUsers">
                                            <th scope="row">{{index+1}}</th>
                                            <th scope="row">{{item.affiliate_id}}</th>
                                            <td>{{item.name}}</td>
                                            <td>{{item.latitude}}</td>
                                            <td>{{item.longitude}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="!isHidden" class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card card-margin">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-12">
                                        <span class="span-list-all">List - Only < 100 Km - INVITE THEM!</span>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body table-all-list">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">ID</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Distance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, index) in orderedDist">
                                            <th scope="row">{{index+1}}</th>
                                            <th scope="row">{{item.id}}</th>
                                            <td>{{item.name}}</td>
                                            <td>{{item.distance}} Km</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        `,
        props: ['data'],
        data(){
            return {
                objArray: this.data,
                distArray: [],
                isHidden: true
            }
        },
        computed: {
            orderedUsers: function () {
                return _.orderBy(this.data, 'affiliate_id')
            },
            orderedDist: function () {
                return _.orderBy(this.distArray, 'id')
            }
        },
        mounted() {
            //console.log(this.data)
        },
        methods: {
            calculateDist(){
                let vm = this
                vm.distArray.splice(0)
                axios.post('/calculateDist', {
                    data: this.data
                })
                .then(function (response) {
                    $.each(response.data, function(key, value) {
                        vm.distArray.push({
                            'id': value.id,
                            'name': value.name,
                            'distance': value.distance
                        })
                    });
                })
                vm.isHidden = false;
            }
        }
    }
</script>
