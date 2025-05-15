```mermaid
erDiagram
    users ||--o{ proyectos : "1:N"
    proyectos ||--o{ valores : "1:N"
    proyectos ||--o{ objetivos_principales : "1:N"
    proyectos ||--o{ cadenadevalor : "1:1"
    objetivos_principales ||--o{ objetivos_especificos : "1:N"
    proyectos ||--o{ analisis_foda : "1:N"
    proyectos ||--o{ cadena_valor : "1:N"
    proyectos ||--o{ fuerzas_porter : "1:N"
    proyectos ||--o{ matriz_came : "1:N"
    proyectos ||--o{ matriz_participacion : "1:N"

    users {
        int id PK
        string name
        string email
        string password
        timestamp created_at
    }
    
    proyectos {
        int id PK
        int user_id FK
        string nombre_proyecto
        text descripcion
        text mision
        text vision
        text unidades_estrategicas
        timestamp created_at
        timestamp updated_at
    }
    
    valores {
        int id PK
        int proyecto_id FK
        string valor
        timestamp created_at
        timestamp updated_at
    }
    
    objetivos_principales {
        int id PK
        int proyecto_id FK
        text objetivo
        timestamp created_at
        timestamp updated_at
    }
    
    objetivos_especificos {
        int id PK
        int objetivo_principal_id FK
        text objetivo
        timestamp created_at
        timestamp updated_at
    }
    
    cadenadevalor {
        int id PK
        int proyecto_id FK
        text reflexion
        int pregunta1
        int pregunta2
        int pregunta3
        int pregunta4
        int pregunta5
        int pregunta6
        int pregunta7
        int pregunta8
        int pregunta9
        int pregunta10
        int pregunta11
        int pregunta12
        int pregunta13
        int pregunta14
        int pregunta15
        int pregunta16
        int pregunta17
        int pregunta18
        int pregunta19
        int pregunta20
        int pregunta21
        int pregunta22
        int pregunta23
        int pregunta24
        int pregunta25
        timestamp created_at
        timestamp updated_at
    }
    
    analisis_foda {
        int id PK
        int plan_id FK
        enum tipo
        text descripcion
        timestamp created_at
        timestamp updated_at
    }
    
    cadena_valor {
        int id PK
        int plan_id FK
        string actividad
        enum tipo
        text descripcion
        timestamp created_at
        timestamp updated_at
    }
    
    fuerzas_porter {
        int id PK
        int plan_id FK
        enum fuerza
        text descripcion
        timestamp created_at
        timestamp updated_at
    }
    
    matriz_came {
        int id PK
        int plan_id FK
        string estrategia
        enum tipo
        text descripcion
        timestamp created_at
        timestamp updated_at
    }
    
    matriz_participacion {
        int id PK
        int plan_id FK
        string area
        text participacion
        timestamp created_at
        timestamp updated_at
    }
    
    cache {
        string key PK
        mediumtext value
        int expiration
    }
    
    cache_locks {
        string key PK
        string owner
        int expiration
    }
    
    sessions {
        string id PK
        bigint user_id
        string ip_address
        text user_agent
        text payload
        int last_activity
    }