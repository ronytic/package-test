<template>
    <div>
        <b-row>
            <b-col>
                <h1>Panel Control</h1>
            </b-col>
        </b-row>
        <b-row>
            <b-col>
                <vuetable
                    :api-mode="false"
                    :fields="fields"
                    :data="mydata"
                    :css="css.table"
                    ref="vuetable"
                >
                </vuetable>
            </b-col>
        </b-row>
        <b-row>
            <b-col>
                <b-button
                    @click="switchShowOrHideAddFields"
                    variant="outline-secondary"
                >
                    <i class="fa fa-plus"></i> Add Register
                </b-button>
            </b-col>
            <b-col cols="8">
                <!-- Card add new register -->
                <b-card v-if="showAddFields" header="Add new register">
                    <b-card-body>
                        <b-row>
                            <b-col>
                                <b-form-select
                                    v-model="region"
                                    :options="options"
                                    :state = "this.region == null ? false : true"
                                ></b-form-select>
                            </b-col>
                            <b-col>
                                <b-form-select
                                    v-model = "newData.country"
                                    :options = "newData.countryOptions"
                                    :disabled = "(this.newData.countryOptions).length > 2 ? false : true"
                                ></b-form-select>
                            </b-col>
                        </b-row>
                        <b-row class="mt-3">
                            <b-col class="text-right">
                                <b-button
                                    :disabled = "this.newData.country == null ? true : false"
                                    variant="outline-info"
                                    @click="save"
                                >
                                    <i class="fa fa-save"></i> SAVE
                                </b-button>
                                <b-button
                                    variant="outline-danger"
                                    @click="switchShowOrHideAddFields"
                                >
                                    <i class="fa fa-times"></i> CLOSE
                                </b-button>
                            </b-col>
                        </b-row>
                    </b-card-body>
                </b-card>
            </b-col>
            <b-col cols="2"></b-col>
        </b-row>
    </div>
</template>


<script>
    export default {
        data() {
            return {
                region: null,
                country: null,
                country_id: null,
                options: [
                    { value: null, text: 'Please select an option' },
                    { value: 'South America', text: 'South America' },
                    { value: 'North America', text: 'North America' },
                    { value: 'Central America', text: 'Central America' },
                    { value: 'Africa', text: 'Africa' },
                    { value: 'Asia', text: 'Asia' }
                ],
                fields: [
                    {
                        name: "country_id",
                        title: "Conutry ID",
                        sortField: "country_id",
                    },
                    {
                        name: "country",
                        title: "Conutry",
                        sortField: "country",
                    },
                    {
                        name: "region",
                        title: "Region",
                        sortField: "region",
                    }
                ],
                mydata: [],
                css: {
                    table: {
                        tableClass: 'table table-striped table-bordered table-hovered',
                        loadingClass: 'loading',
                        ascendingIcon: 'glyphicon glyphicon-chevron-up',
                        descendingIcon: 'glyphicon glyphicon-chevron-down',
                        handleIcon: 'glyphicon glyphicon-menu-hamburger',
                    }
                },
                showAddFields: false,
                newData: {
                    country: null,
                    countryOptions: [
                        { value: null, text: 'Please select an country' }
                    ],
                }
            };
        },
        methods: {
            switchShowOrHideAddFields () {
                this.showAddFields = !this.showAddFields;
            },
            getRegisters() {
                this.mydata = [];
                ProcessMaker.apiClient
                    .get("admin/package-test/getregisters")
                    .then((response) => {
                        let res = response.data;
                        for (const key in res.data) {
                            let object = res.data[key];
                            this.mydata.push(
                                {
                                    country: object.country,
                                    region: object.region,
                                    country_id: object.country_id,
                                    region_id: object.region_id,
                                    created_at: object.created_at,
                                    updated_at: object.updated_at,
                                    deleted_at: object.deleted_at,
                                }
                            );
                        }

                    });
            },
            getCountries () {
                this.emptyCountries();
                // Prepare data to send
                let data = new FormData();
                data.append( "region", this.region == null ? "" : this.region );
                // Call API
                ProcessMaker.apiClient
                    .post("admin/package-test/searchcountries", data)
                    .then((response) => {
                        let res = response.data;
                        if (res.status == "success") {
                            let resData = res.data;
                            if (typeof(resData) == "object") {
                                for (const key in resData) {
                                    if (Object.hasOwnProperty.call(resData, key)) {
                                        const element = resData[key];
                                        this.newData.countryOptions.push({
                                            value: key,
                                            text: element.country
                                        });
                                    }
                                }
                            }
                        }
                    });
            },
            save() {
                let region = this.region;
                let country = this.newData.country;
                let country_id = this.newData.countryOptions.find(element => element.value == country).text;
                // // Prepare data to send
                let data = new FormData();
                data.append( "region", region);
                data.append( "country", country);
                data.append( "country_id", country_id);
                // Call API
                ProcessMaker.apiClient
                    .post("admin/package-test/savecountry", data)
                    .then((response) => {
                        let res = response.data;
                        if (res.status == "success") {
                            ProcessMaker.alert(res.message, 'success');
                        } else {
                            ProcessMaker.alert(res.message, 'danger');
                        }
                        this.getRegisters();
                        this.showAddFields = false;
                    });
            },
            emptyCountries() {
                this.newData.country = null,
                this.newData.countryOptions = [
                        { value: null, text: 'Please select an country' }
                    ];
            }
        },
        watch: {
            region: function (value) {
                this.emptyCountries();
                this.getCountries();
            },
            showAddFields: function (value) {
                if (value == false) {
                    this.region = null;
                    this.emptyCountries();
                }
            }
        },
        mounted() {
            this.getRegisters();
        },
    };
</script>

<style>
    .table thead th{
        background: white;
    }
</style>
