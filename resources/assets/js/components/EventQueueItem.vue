<template>

    <!-- <div class="box box-default box-solid"> -->
    <div :class="liveTimeStatusClass" class="box box-solid">

        <div class="box-header with-border">
            <div class="row">
                <div class="col-sm-4">
                    <div class="box-date-top pull-left">{{item.start_date | titleDateLong}}</div>
                    <div class="pull-right">
                        <label data-toggle="tooltip" data-placement="top" title="Promoted"><span class="item-promoted-icon" :class="promotedIcon"></span></label>
                    </div><!-- /.pull-right -->
                </div><!-- /.col-sm-6 -->
                <div class="col-sm-8">
                    <form class="form-inline pull-right">
                        <div class="form-group">
                            <button v-if="hasPriorityChanged" @click.prevent="updateItem" class="btn footer-btn bg-orange btn-xs" href="#"><span class="fa fa-floppy-o"></span></button>
                        </div><!-- /.form-group -->
                      <div class="form-group">
                        <label class="sr-only" for="priority-number">Priority</label>
                            <select id="priority-{{item.id}}" v-model="patchRecord.priority" @change="priorityChange($event)" class="form-control" number>
                                <option v-for="option in options" v-bind:value="option.value">
                                    {{option.text}}
                                </option>
                            </select>
                      </div>
                      <div class="form-group">
                              <label>approved:</label>
                          </div><!-- /.form-group -->
                         <div class="form-group">
                              <vui-flip-switch id="switch-{{item.id}}"
                                  v-on:click.prevent="changeIsApproved"
                                  :value.sync="patchRecord.is_approved" >
                              </vui-flip-switch>
                          </div>
                      </form>
                </div><!-- /.col-sm-6 -->
            </div><!-- /.row -->

            <div class="row">
              <a v-on:click.prevent="toggleBody" href="#">
                <div class="col-sm-12">
                    <h6 class="box-title">{{item.title}}</h6>
                </div><!-- /.col-md-12 -->
              </a>
            </div><!-- /.row -->
        </div>  <!-- /.box-header -->

        <div v-if="showBody" class="box-body">

            <p>From: {{item.start_time}} to {{item.end_time}}</p>
            <p>{{item.description}}</p>
            <div class="item-info">
            Dates: {{item.start_date}} - {{item.end_date}}
            </div>

        <template v-if="canHaveImage">
            <img v-if="hasEventImage" :src="imageUrl" />
            <a v-on:click.prevent="togglePanel" class="btn bg-olive btn-sm" href="#">{{hasEventImage ? 'Change Image' : 'Promote Event'}}</a>
            <div v-show="showPanel" class="panel">
                <form id="form-mediafile-upload{{item.id}}" @submit.prevent="addMediaFile" class="m-t" role="form" action="/api/event/addMediaFile/{{item.id}}"  enctype="multipart/form-data">
                    <input class="hidden" type="input" value="{{item.id}}" v-model="formInputs.event_id">
                    <div class="form-group">
                        <label for="event-image">Event Image</label><br>
                        <input v-el:eventimg type="file" name="eventimg" id="eventimg">
                    </div>
                    <button id="btn-mediafile-upload" type="submit" class="btn btn-primary block m-b">Submit</button>
                </form>
            </div><!-- /.panel mediaform -->
        </template>

        </div><!-- /.box-body -->


        <div :class="addSeperator" class="box-footer list-footer">
            <div class="row">
                <div class="col-sm-9">
                    <span>Start {{item.start_date_time}}</span> <span>End {{item.end_date_time}}</span>

                    <span :class="timeFromNowStatus">Live {{timefromNow}}</span> <span :class="timeLeftStatus">{{timeLeft}}</span>



                </div><!-- /.col-md-7 -->
                <div class="col-sm-3">
                    {{item.id}}
                    <div class="btn-group pull-right">

                            <button v-on:click.prevent="editItem" class="btn bg-orange btn-xs footer-btn"><i class="fa fa-pencil"></i></button>
                            <!-- <button v-on:click.prevent="previewItem" class="btn bg-orange btn-xs footer-btn"><i class="fa fa-eye"></i></button> -->
                    </div><!-- /.btn-toolbar -->

                </div><!-- /.col-md-7 -->
            </div><!-- /.row -->
        </div><!-- /.box-footer -->
</div><!-- /.box- -->

</template>
<style scoped>
.box {
    color: #1B1B1B;
    margin-bottom: 10px;
}
.box-body {
    background-color: #fff;
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
    margin:0;
}

.box-header {
    padding: 3px;
}
.box-footer {
    padding: 3px;
}
h5.box-footer {
    padding: 3px;
}
button.footer-btn {
    border-color: #999999;

}
h6.box-title {
    font-size: 16px;
    color: #1B1B1B;
}
    .box-date-top {

    }
    .box-date-bot {

    }
    .box-date {

    }
        select.form-control {
            height:22px;
            border: 1px solid #999999;
        }

        h6 {
            margin-top: 0;
            margin-bottom: 0;
        }
        h5 {
            margin-top: 0;
            margin-bottom: 0;
        }

        .form-group {
            /*border: 1px solid red;*/
        }
        .form-group label{
            margin-bottom: 0;
        }
        .topitems {
            /*background-color: #9B59B6;*/
            background-color: #76D7EA;
            border: 2px solid #9B59B6;
        }
        .ongoing {
            background-color: #bfff00;
            border: 1px solid #999999
        }
        .event-positive {

            background-color: #D8D8D8;
            border: 1px solid #999999;
        }
        .event-negative {

            background-color: #ffcc33;
            border: 1px solid #999999;
        }
        .is-promoted {

            background-color: #76D7EA;
            /*border: 1px solid #999999*/
        }
        .time-is-short {
            color: #F39C12;
        }
        .time-is-long {
            color: #999999;
        }
        .time-is-over {
            color: #9B59B6;
        }
        .last-special-event {
            margin-bottom: 50px;
        }

        /*.box.box-solid.box-default {
            border: 1px solid #999999;
        }
        .box-body {
            padding: 3px 6px;
        }*/
</style>
<script>
import moment from 'moment'
import VuiFlipSwitch from './VuiFlipSwitch.vue'

module.exports  = {
    components: {VuiFlipSwitch},
    props: ['item','pid','index'],
    data: function() {
        return {
            hasPriorityChanged:0,
            options: [
                { text: '0', value: 0 },
                { text: '1', value: 1 },
                { text: '2', value: 2 },
                { text: '3', value: 3 },
                { text: '4', value: 4 },
                { text: '5', value: 5 },
                { text: '6', value: 6 },
                { text: '7', value: 7 },
                { text: '8', value: 8 },
                { text: '9', value: 9 },
                { text: '10', value: 10 },
                { text: '99', value: 99 }
            ],
            formInputs: {
                event_id: '',
                attachment: ''

            },
            showBody: false,
            showPanel: false,
            initRecord: {
                is_approved: 0,
                priority: 0,
                is_canceled: 0,
                eventimage: ''
            },
            patchRecord: {
                is_approved: 0,
                priority: 0,
                is_canceled: 0,
                eventimage: ''
            },
            currentDate: {},
            record: {
            }
        }
    },
    created: function () {
        // this.is_approved = this.item.approved;
        // this.currentDate = moment();
        // console.log('this.currentDate=' + this.currentDate)
    },
    ready: function() {
        this.initRecord.is_approved = this.patchRecord.is_approved =  this.item.is_approved;
        this.initRecord.priority = this.patchRecord.priority = this.item.priority;
        this.initRecord.is_canceled = this.patchRecord.is_canceled = this.item.is_canceled;
        this.initRecord.eventimage = this.patchRecord.eventimage = this.item.eventimage;
    },
    computed: {
        addSeperator: function(){
            let asclass = 'box-footer-normal';
            if(this.pid == 'items-other' && this.index == 3) {
                asclass = 'box-footer-last-special';
            }
            return asclass;
        },
        hasPriorityChanged: function(){
            if (this.initRecord.priority != this.patchRecord.priority){
                return true
            } else {
                return false
            }
        },
        hasIsApprovedChanged: function(){
            if (this.initRecord.is_approved != this.patchRecord.is_approved){
                console.log('is_approved => initRecord='+ this.initRecord.is_approved  + ' patchRecord=>' +this.patchRecord.is_approved );
                return true
            } else {
                return false
            }
        },
        timeLeftStatus: function(){
            let diff = this.timeDiffNow(this.item.end_date_time)
            if(diff <= 0){
                return 'time-is-over'
            } else if(diff > 0 && diff <=720) {
                return 'time-is-short'
            } else {
                return 'time-is-long'
            }


        },

        timeFromNowStatus: function(){
            let diff = this.timeDiffNow(this.item.start_date_time)
            if(diff <= 0){
                return 'time-is-over'
            } else if(diff > 0 && diff <=720) {
                return 'time-is-short'
            } else {
                return 'time-is-long'
            }
        },
        timefromNow:function() {
            return moment(this.item.start_date_time).fromNow()
        },
        timeLeft: function() {

            if(moment(this.item.start_date_time).isSameOrBefore(moment())){
                let tlft = this.timeDiffNow(this.item.end_date_time);
                console.log('id='+ this.item.id + ' timeLeft'+tlft)
                if (tlft < 0) {
                    return 'Event Ended ' + moment(this.item.end_date_time).fromNow()
                } else {
                    return  ' and Ends ' + moment(this.item.end_date_time).fromNow()
                }

            }  else {
                return ''
            }


        },
        liveTimeStatusClass: function(){
            let timepartstatus;
            let extrasep;
            if (moment().isBetween(this.item.start_date_time, this.item.end_date_time)){
                timepartstatus=  'ongoing';
            } else {
                if(this.timeDiffNow(this.item.start_date_time) < 0 ) {
                    timepartstatus = 'event-negative';
                } else {
                    timepartstatus = 'event-positive';

                }

            }

            if (this.pid == 'items-other' && this.index === 3) {
                extrasep = 'last-special-event'
            } else {
                extrasep = ''
            }

            return timepartstatus + ' ' + extrasep;


        },
        itemStatus : function() {
            let sclass = 'box-default';

            // console.log('pid' + this.pid + ' index='+ this.index);
            if (this.pid == 'items-other'){
                if(this.index < 4){
                    console.log('topitems');
                    sclass = 'topitems';
                }
            }
            // if (this.item.is_promoted === 1){
            //     pclass =  'is-promoted'
            //   } else {
            //      pclass = 'box-default'
            //   }
              return sclass;

        },
        promotedIcon: function() {
            if (this.item.is_promoted === 1){
                pIcon = 'fa fa fa-star'
              } else {
                  pIcon = ''
              }
              return pIcon
         },
        hasEventImage:function() {
            if(this.item.eventimage){
                return true;
            } else {
                return false;
            }

        },
        canHaveImage:function() {
            if(this.item.is_approved){
                return true;
            } else {
                return false;
            }

        },
        imageUrl:function() {
            var pth = "/imagecache/smallthumb/";
            var fname = this.item.eventimage;
            console.log(pth + fname)
            return pth + fname;
        },

        isApproved: function() {
            return this.item.is_approved;
        },
        itemEditPath: function(){
            return '/admin/event/'+ this.item.id + '/edit'
        },
        itemPreviewPath: function(){
            return '/preview/event/'+ this.item.id
        },



    },
    methods:{
        // We will call this event each time the file upload input changes. This will push the data to our data property above so we can use the data on form submission.
            // onFileChange(event) {
            //     console.log("event.target.file" + event.target.file)
            //     this.formInputs.attachment = event.target.file;
            // },
            // Handle the form submission here
            timeDiffNow:function(val){
                return  moment(val).diff(moment(), 'minutes');

            },
            changeIsApproved: function(){
                this.patchRecord.is_approved = (this.item.is_approved === 0)?1:0;
                console.log('this.patchRecord.is_approved ='+this.patchRecord.is_approved );
                this.updateItem();

            },
            editItem: function(ev) {
                window.location.href = this.itemEditPath;
            },
            priorityChange(event){
                console.log('priority=' + this.item.priority)
            },

           addMediaFile(event) {
               event.preventDefault();
               event.stopPropagation();

               var files = this.$els.eventimg.files;
               var data = new FormData();
               data.append('event_id', this.formInputs.event_id);

               // Since we have multiple files, we will loop through them and add them to an array in our form object.
            //    for(var key in this.formInputs.attachment) {
                data.append('eventimg', files[0]);
            //    }
                // var formid = '#form-mediafile-upload'+this.item.id;
                // var action =  $(formid).action;
            var action = '/api/event/addMediaFile/'+ this.formInputs.event_id;
               this.$http.post(action, data , {
                    method: 'PUT'
               } )
               .then((response) => {
                   console.log('good?'+ response)
                   this.checkAfterUpdate(response.data.newdata)
               }, (response) => {
                   console.log('bad?'+ response)
               });
            //    var action = $('#form-submit-ticket').action;
               // POST the data to our Laravel controller
            //    this.$http.post(action, form, function(response) {
            //        console.log('Success:', response)
            //    })
           },
           updateItem: function(){
            //    this.patchRecord.is_approved = this.item.is_approved;
            //    this.patchRecord.priority = this.item.priority;
               this.patchRecord.is_canceled = this.item.is_canceled;

               this.$http.patch('/api/event/updateItem/' + this.item.id , this.patchRecord , {
                   method: 'PATCH'
               } )
               .then((response) => {
                   console.log('good?'+ response)
                   this.checkAfterUpdate(response.data.newdata)

                   }, (response) => {
                       console.log('bad?'+ response)
                   });
           },
           checkAfterUpdate: function(ndata){
               this.item.is_approved = this.initRecord.is_approved =   ndata.is_approved;
               this.item.priority = this.initRecord.priority =  ndata.priority;
               this.item.is_canceled = this.initRecord.is_canceled = ndata.is_canceled;
               this.item.eventimage =  this.initRecord.eventimage = ndata.eventimage;
               this.hasPriorityChanged = 0;

               console.log(ndata);
           },

        //    AddMediaFileToEvent: function(item, args){
        //        console.log(args)
        //        var currentRecordId =  item.id;
        //        var currentRecord = args;
           //
        //        this.$http.patch('/api/event/updateItem/' + item.id , currentRecord , {
        //            method: 'PATCH'
        //        } )
        //        .then((response) => {
        //            console.log('good?'+ response)
        //            var movedIndex = this.movedItemIndex(movedid);
        //                // this.xitems.pop(movedRecord);
        //            // if (movedRecord.approved == 1) {
        //            //         this.xitems.splice(movedIndex, 1);
        //            //      this.items.push(movedRecord);
        //            //  } else {
        //            //      this.items.splice(movedIndex, 1);
        //            //     this.xitems.push(movedRecord);
        //            //  }
           //
        //                console.log('movedIndex==='+ movedIndex)
        //            }, (response) => {
        //                console.log('bad?'+ response)
        //            });
        //    },



        togglePanel: function(ev) {
            if(this.showPanel === false) {
                this.showPanel = true;
            } else {
                this.showPanel = false;
            }
            console.log('this.showPanel' + this.showPanel)
        },
        toggleBody: function(ev) {
            if(this.showBody == false) {
                this.showBody = true;
            } else {
                this.showBody = false;
            }
            console.log('toggleBody' + this.showBody)
        },
        doThis: function(ev) {
            this.item.is_approved = (this.is_approved === 0)?1:0;
           this.$emit('item-change',this.item);
        //console.log('ev ' + ev + 'this.item.id= '+  this.item.priority)
        },
        // addMediaFile: function(ev) {
        //     var formData = new FormData();
        //     formData.append('image', fileInput ,this.$els.finput.files[0]);
        //
        //     // var fileinputObject = this.$els.finput;
        //     // console.log('fileinputObject.name= '+ fileinputObject.name)
        //     // console.log('fileinputObject.value= '+ fileinputObject.value)
        //     // console.log('fileinputObject.files= '+ fileinputObject.files[0])
        //     this.$emit('add-media-file', formData);
        //     console.log('ev ' + ev + 'this.item.id= '+  this.item)
        // }

    },
    watch: {
        priorityChanged: function(val, oldVal) {
            if (val !=  oldVal) {
                return true
            } else {
                return false
            }
        }
    },
    directives: {
        // mydatedropper: require('../directives/mydatedropper.js')
        // dtpicker: require('../directives/dtpicker.js')
    },

    filters: {
        titleDay: function (value) {
            return  moment(value).format("ddd")
        },
        titleDate: function (value) {
            return  moment(value).format("MM/DD")
        },
        titleDateLong: function (value) {
            return  moment(value).format("ddd MM/DD")
        },
        momentPretty: {
            read: function(val) {
                console.log('read-val'+ val )

                return 	val ?  moment(val).format('MM-DD-YYYY') : '';
            },
            write: function(val, oldVal) {
                console.log('write-val'+ val + '--'+ oldVal)

                return moment(val).format('YYYY-MM-DD');
            }
        }
    },
    events: {

        // 'building-change':function(name) {
        // 	this.newbuilding = '';
        // 	this.newbuilding = name;
        // 	console.log(this.newbuilding);
        // },
        // 'categories-change':function(list) {
        // 	this.categories = '';
        // 	this.categories = list;
        // 	console.log(this.categories);
        // }
    }
};


</script>
