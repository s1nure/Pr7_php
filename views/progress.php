<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PR 7</title>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
    <ul>
        <li><a href="/Pr8/">Students</a></li>
        <li><a href="/Pr8/index.php/subjects">Subjects</a></li>
        <li><a href="/Pr8/index.php/progress">Progress</a></li>
    </ul>

    <div id="app">
        <form @submit.prevent="addProgress()">
            <div class="msg" v-if="message">{{message}}</div>
            <input type="number" name="mark"  v-model="newItem.mark" placeholder="Mark" required /><br>

            <select v-model="newItem.student_id">
                <option v-for="s in students" :value="s.id">{{ s.name }}</option>
            </select><br>
            <select v-model="newItem.subject_id">
                <option v-for="subject in subjects" :value="subject.id">{{ subject.name }}</option>
            </select><br>
            <input type="submit" value="Добавить">
        </form>

    
        <table v-if="progress">
            <tr>
                <th>Имя</th>
                <th>Предмет</th>
                <th>Оценка</th>
                <th>Действие</th>
            </tr>
            <tr v-for="p in progress" :key="p.id">
                <td>
                    <select v-model="p.student_id">
                        <option v-for="s in students" :value="s.id" :selected="s.id === p.student_id">{{ s.name }}</option>
                    </select>
                </td>
                <td>
                    <select v-model="p.subject_id">
                        <option v-for="subject in subjects" :value="subject.id" :selected="subject.id === p.subject_id">{{ subject.name }}</option>
                    </select>
                </td>
                <td><input type="text" v-model="p.mark" placeholder="mark" required /></td>
                <td>
                    <button type="button" @click="deleteProgress(p)">Delete</button>
                    <button type="button" @click="updateStudent(p)">Update</button>
                </td>
            </tr>
        </table>


    </div>

     <script>
        new Vue({
            el: "#app",
            data: {
                newItem:[],
                message: '',
                students: {},
                progress: {},
                subjects: {}
            },
            mounted: function() {
                this.getData();
            },
            methods:{
                getData:function(){
                let self = this;
                axios.get("http://localhost:8888/Pr8/index.php/progress/getData").then(function(response){
                    if(response.data.students) self.students = response.data.students;
                    if(response.data.progress) self.progress = response.data.progress;
                    if(response.data.subjects) self.subjects = response.data.subjects;
                });
                },
                toFormData:function(obj){
                    const fd = new FormData();
                    for(let i in obj){
                        fd.append(i, obj[i]);
                    }
                    return fd;
                },

                addProgress:function(){
                    if(this.newItem) {
                        let self = this;
                        const formData = this.toFormData(this.newItem);
                        axios.post("http://localhost:8888/Pr8/index.php/progress/addProgress", formData)
                            .then((response) => {
                                self.getData();
                                self.newItem = [];
                                self.message= "Успеваемость успешно добавлена";
                                setTimeout(() => {
                                    self.message= "";
                                }, 5000);
                            });
                    }
                },    
                updateStudent:function(progress){
                    let self = this;
                    if(progress){
                        const formData = this.toFormData(progress);
                        formData.append('update', progress.id);

                        axios.post("http://localhost:8888/Pr8/index.php/progress/actions", formData)
                            .then(() => {
                                this.getData();
                                this.newItem = [];
                                this.message= "Успеваемость успешно изменена";
                                setTimeout(() => {
                                    this.message="";
                                },5000);
                            });
                    }
                },
                deleteProgress:function(progress){
                    let self = this;
                    if(progress){
                        const formData = this.toFormData(progress);
                        formData.append('delete', progress.id);

                        axios.post("http://localhost:8888/Pr8/index.php/progress/actions", formData)
                            .then(() => {
                                this.getData();
                                this.newItem = [];
                                this.message= "Успеваемость успешно удалена";
                                setTimeout(() => {
                                    this.message="";
                                },5000);
                            });
                    }
                }
            }
        });

    </script>
</body>
</html>
