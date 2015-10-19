//
//  ItemSearch.m
//  Groceries
//
//  Created by Martin Isaza on 10/17/15.
//  Copyright © 2015 Martin Isaza. All rights reserved.
//

#import "ItemSearch.h"

@implementation ItemSearch

- (void)getItemsFromSearch:(NSString *)searchText withCallback: (void (^) (NSMutableArray *results)) completion {
    NSMutableDictionary *item1 = [[NSMutableDictionary alloc] init];
    item1[@"Price"] = @"3.15";
    item1[@"ItemDesc"] = @"Milk";
    item1[@"PhotoURL"] = @"http://scene7.targetimg1.com/is/image/Target/47103898?wid=138&hei=138&qlt=85&fmt=pjpeg";
    item1[@"Seller"] = @"Target";
    
    NSMutableDictionary *item2 = [[NSMutableDictionary alloc] init];
    item2[@"Price"] = @"3.01";
    item2[@"ItemDesc"] = @"Juice";
    item2[@"PhotoURL"] = @"http://scene7.targetimg1.com/is/image/Target/16192787?wid=138&hei=138&qlt=85&fmt=pjpeg";
    item2[@"Seller"] = @"Walmart";
    
    NSMutableDictionary *item3 = [[NSMutableDictionary alloc] init];
    item3[@"Price"] = @"3.70";
    item3[@"ItemDesc"] = @"Eggs";
    item3[@"PhotoURL"] = @"http://ll-us-i5.wal.co/dfw/dce07b8c-7799/k2-_016bddad-03f0-4389-b74e-9942dd428d71.v2.jpg-3b4944cba3e48aa47def131355696776569d6482-webp-180x180.webp";
    item3[@"Seller"] = @"Meijer";
    
    
    
    NSArray *resultsArray = [[NSArray alloc] initWithObjects:item1, item2, item3, nil];
    
    NSMutableArray *pricesArray = [[NSMutableArray alloc] init];
    
    for (int i = 0; i < resultsArray.count; i++) {
        float d = [resultsArray[i][@"Price"] floatValue];
        NSNumber *price = [NSNumber numberWithFloat:d];
        [pricesArray addObject:price];
    }
    
    NSArray *sortedPrices = [pricesArray sortedArrayUsingSelector:@selector(compare:)];
    NSMutableArray*finalArray = [[NSMutableArray alloc] initWithArray:resultsArray];
    
    for (int n = 0; n < resultsArray.count; n++) {
        for (int k = 0; k < sortedPrices.count; k++) {
            float d = [resultsArray[n][@"Price"] floatValue];
            NSNumber *price = [NSNumber numberWithFloat:d];
            
            if (price == sortedPrices[k]) {
                
                [finalArray setObject:resultsArray[n][@"Price"] atIndexedSubscript:k];
                
            }
        }
    }
    NSLog(@"SORTED: %@", finalArray);
    
    completion([resultsArray mutableCopy]);
}


- (void)POST2ForGroceriesOnProduct:(NSString *)productName andCompletion:(void (^) (NSArray *returnedArray, NSError *Error))completionHandler {
    NSString *stringURL = [NSString stringWithFormat:@"http://aislefive.rileyshaw.net/index.php/submit"];
    
        NSURL *url = [NSURL URLWithString:stringURL];
    
        NSMutableURLRequest *request = [NSMutableURLRequest requestWithURL:url];
        request.HTTPMethod = @"POST";
        NSString *post = [NSString stringWithFormat:@"product=%@", productName];
        NSData *postData = [post dataUsingEncoding:NSASCIIStringEncoding allowLossyConversion:YES];
    
        //content type header
        [request setValue:@"application/x-www-form-urlencoded" forHTTPHeaderField:@"Content-Type"];
        [request setHTTPBody:postData];
        NSURLSession *session = [NSURLSession sharedSession];
    
        NSMutableDictionary *requestBodyDict = [[NSMutableDictionary alloc] init];
        [requestBodyDict setObject:productName forKey:@"product"];
    
        NSString *StringJSONbody = [self jsonStringFromDictionary:requestBodyDict];
    
        if (StringJSONbody != nil) {
        
                NSData *DataJSONbody = [StringJSONbody dataUsingEncoding:NSASCIIStringEncoding allowLossyConversion:YES];
        
                //[request setHTTPBody:DataJSONbody];
        
                //make task
                NSURLSessionDataTask *postDataTask = [session dataTaskWithRequest:request completionHandler:^(NSData *data, NSURLResponse *response, NSError *error) {
                    
                    NSString *returnString = [[NSString alloc] initWithData:data encoding:NSUTF8StringEncoding];
                    NSLog(@"DATASTRING:%@", returnString);
                    returnString = [returnString substringFromIndex:1];
                    
                    //returnString = [returnString stringByReplacingOccurrencesOfString:@"\\" withString:@""];
                    
                    NSData *stringData = [returnString dataUsingEncoding:NSUTF8StringEncoding];
                    
                    //NSLog(@"RESPONSE%@", response);
                    NSArray *jsonArray = [NSJSONSerialization JSONObjectWithData:stringData options:NSJSONReadingMutableContainers error:&error];
                    
                    
                    //WORKING: pattern = @"(http://i.walmartimages.com.*?.jpg)"
                    NSLog(@"RESPONSEJSON:%@", jsonArray);
                    //parse out the urls
                    NSString *pattern = [[NSString alloc] init];
                    for (int k = 0; k < jsonArray.count; k++) {
                        if ([jsonArray[k][@"storeName"]  isEqual: @"Walmart"]) {
                            
                            pattern = @"(http://.*?.walmartimages.com.*?.jpg)";
                        }
                        
                        else if ([jsonArray[k][@"storeName"]  isEqual: @"Meijer"]) {
                            pattern = @"(http://.*?.meijer.com.*?.jpg)";
                        }
                        
                        else if ([jsonArray[k][@"storeName"] isEqualToString:@"Target"]) {
                            pattern = @"(http://.*?.targetimg1.com.*?.jpeg)";
                        }
                        
                        NSRegularExpression* regex = [NSRegularExpression regularExpressionWithPattern:pattern options:0 error:&error];
                        
                        
                        NSString *images = jsonArray[k][@"images"];
                        NSArray* matches = [regex matchesInString:images options:0 range:NSMakeRange(0, [images length])];
                        
                        //NSLog(@"%@", [images substringWithRange:match.range]);
                        if (matches.count > 0) {
                            NSTextCheckingResult *match = matches[0];
                            jsonArray[k][@"URL"] = [images substringWithRange:match.range];
                        }
                        else {
                            jsonArray[k][@"URL"] = nil;
                        }
                        
                    }
                    
                    //NSLog(@"MATCHES: %@", matches);
                    
                    NSLog(@"RESPONSEJSON:%@", jsonArray);
                    completionHandler(jsonArray, error);
                    
                }];
            [postDataTask resume];
        }
}


- (NSString *)jsonStringFromDictionary:(NSMutableDictionary *) dictToTranslate {
    NSError *error;
    NSData *jsonData = [NSJSONSerialization dataWithJSONObject:dictToTranslate
                                                       options:NSJSONWritingPrettyPrinted error:&error];
    NSString *jsonString;
    if (!jsonData) {
        NSLog(@"Got an error in converting data to json string: %@", error);
        jsonString = nil;
    }
    
    else {
        jsonString = [[NSString alloc] initWithData:jsonData encoding:NSUTF8StringEncoding];
    }
    
    return jsonString;
}

@end
