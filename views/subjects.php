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
        <form @submit.prevent="addSubject()">
            <div class="msg" v-if="message">{{message}}</div>
            <input type="text" v-model="newItem.name" placeholder="Name" required />
            <input type="submit" value="Добавить">
        </form>

        <table v-if="subjects">
            <tr>
            <th>Ім'я</th>

            </tr>
            
            <tr v-for="s in subjects">
            <td><input v-model="s.name"></td>
            
            <td><button type="submit" @click.prevent="updateSubject(s)" name="update">Оновити</button></td>
            <td><button type="submit" @click.prevent="deleteSubject(s)" name="delete">Видалити</button></td>
            </tr>
        </table>  
    </div>


    <script>
        new Vue({
            el: "#app",
            data: {
                newItem:[],
                message: '',
                subjects: {},
            },
            mounted: function() {
                this.getData();
            },
            methods:{
                getData:function(){
                let self = this;
                axios.get("http://localhost:8888/Pr8/index.php/subjects/getData").then(function(response){
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

                addSubject:function(){
                    if(this.newItem) {
                        let self = this;
                        const formData = this.toFormData(this.newItem);
                        axios.post("http://localhost:8888/Pr8/index.php/subjects/addSubject", formData)
                            .then((response) => {
                                self.getData();
                                self.newItem = [];
                                self.message= "Предмет успешно добавлен";                                
                                setTimeout(() => {
                                    this.message="";
                                },5000);
                            });
                    }
                },    
                updateSubject:function(subject){
                    let self = this;
                    if(subject){
                        const formData = this.toFormData(subject);
                        formData.append('update', subject.id);

                        axios.post("http://localhost:8888/Pr8/index.php/subjects/actions", formData)
                            .then(() => {
                                this.getData();
                                this.newItem = [];
                                this.message= "Предмет успешно изменен";
                                setTimeout(() => {
                                    this.message="";
                                },5000);
                            });
                    }
                },
                deleteSubject:function(subject){
                    let self = this;
                    if(subject){
                        const formData = this.toFormData(subject);
                        formData.append('delete', subject.id);

                        axios.post("http://localhost:8888/Pr8/index.php/subjects/actions", formData)
                            .then(() => {
                                this.getData();
                                this.newItem = [];
                                this.message= "Предмет успешно удален";
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
