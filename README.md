## API для тестового задания Склад
Перед работой необходимо выполнить:
1. php artisan migrate - Добавить в БД таблицы
2. php artisan db:seed - Заполнить БД случайными значениями

Описание методов:
1. /api/tasks - Получить список задач (с фильтрами и настраиваемой пагинацией) (метод GET) 
   ###### Пример: api/orders?limit=20&page=1&status=canceled&created_at=2022-01-15
   #### Пояснение:
         page - страница
         limit - количество задач на странице
         status - статус задач (active,comleted,canceled)
         created_at - дата создания задач
         
2. /api/tasks - создание задачи (метод POST) в Headers(Content-Type:application/json)
    #### Пример:
            {
            	"desсription": "DESC NEW TASK"
            }
    #### Пояснение:
          desсription - описание
          
3. /api/tasks/{id} - изменение задачи (метод PUT) в Headers(Content-Type:application/json), где {id} - Id-задачи
    #### Пример:
         {
         		"desсription": "DESC updated",
         		"status": "canceled"
         }  
    #### Пояснение:
        desсription - описание задачи
        status - статус задачи
        
4. /api/tasks/{id} - удалить задачу (метод DELETE), где {id} - Id-задачи 