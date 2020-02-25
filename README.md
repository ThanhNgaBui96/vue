<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Project

## Swagger API (Api Docs)

    Swagger is a simple yet powerful tool for documenting projects using the RESTful API
   #### How to use
   

 1. **Define code to Swagger know api.**
     Have 2 way to define:
     - Method 1: define in apidocs/swagger-v1.php
        ````
         /**
         * @OA\Get(
         *     path="/",
         *     description="Home page",
         * 	   @OA\Parameter(
         *         name="limit",
         *         in="query",
         *         description="How many items to return at one time (max 100)",
         *         required=false,
         *         @OA\Schema(
         *             type="integer",
         *             format="int32"
         *         )
         *     ),
         *     @OA\Response(response="default", description="Welcome page")
         * )
         */
        ````
     - Method 2: define before method in controller
        ```
        /**
         * @OA\Get(
         *     path="/api/getUser",
         *     description="Get user infor",
         * 	   @OA\Parameter(
         *         name="role",
         *         in="query",
         *         description="User role",
         *         required=false,
         *         @OA\Schema(
         *             type="integer",
         *             maximum="2",
               default="1"
         *         )
         *     ),
         *     @OA\Response(response="default", description="Welcome page")
         * )
         */
        public function getUser(Request $request)
        {
            $user = [
                'username' => 'fabbi-hoibq',
                'email' => 'hoibq@fabbi.io',
                'age' => 18,
                'role' => $request->query('role') == 1 ? 'admin' : 'editor'
            ];
            return response()->json($user);
        }
        ```

 2. **Run script**
    > cd apidocs
    > ./swagger.sh

    A file openapi.yaml will be created in public/swagger/ directory.
 3. **Go to [http://localhost/swagger/index.html](http://localhost/swagger/index.html)**