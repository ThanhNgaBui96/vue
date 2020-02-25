<?php
/**
 * @OA\Info(title="Base Project", version="0.0.1")
 */

/**
 * @OA\Get(
 *     path="/",
 *     description="Home page",
 *     @OA\Parameter(
 *         name="limit",
 *         in="query",
 *         description="How many items to return at one time (max 100)",
 *         required=false,
 *         @OA\Schema(
 *             type="integer"
, *             format="int32"
 *         )
 *     ),
 *     @OA\Response(response="default", description="Welcome page")
 * )
 */

/**
 * @OA\SecurityScheme(
 *   securityScheme="bearerAuth",
 *   type="http",
 *	 scheme="bearer",
 *	 bearerFormat="JWT"
 * )
 */
